<?php

namespace App\Http\Controllers;

use App\AddServerToken;
use App\Libraries\EjabberdAPI;
use App\Rules\Domain;
use App\Server;
use App\ServerAdmin;
use App\ServerWhitelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ServerController extends Controller
{
    public function index(Request $request)
    {
        $servers = Server::all();

        return view('servers.index', ['servers' => $servers]);
    }

    public function add(Request $request)
    {
        return view('servers.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'domain' => [
                'required',
                new Domain,
            ],
            'h-captcha-response'    => 'required|HCaptcha'
        ]);

        // Validation
        try {
            $response = Http::timeout(5)->get($request->get('domain') . '/?infos');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['server_unreachable' => 'The server cannot be reached']);
        }

        $json = $response->json();

        if (!is_array($json)) {
            return redirect()->back()->withErrors(['not_a_server' => 'The domain doesn\'t host a valid Movim server']);
        }

        $addServerToken = new AddServerToken;
        $addServerToken->domain = $request->get('domain');
        $addServerToken->token = Str::random(10);
        $addServerToken->save();

        foreach ($json['admins'] as $adminJid) {
            $api = new EjabberdAPI;
            $api->sendMessage(
                $adminJid,
                'Join Movim Server registration validation',
                'You are currently registering your server on join.movim.eu, here is the unique link to confirm your registration: ' . route('servers.create_confirmation', $addServerToken->token)
            );
        }

        return view('servers.create', [
            'json' => $json,
            'domain' => $request->get('domain')
        ]);
    }

    public function createConfirmation(Request $request, string $token)
    {
        $addServerToken = AddServerToken::where('token', $token)->firstOrFail();

        try {
            $response = Http::timeout(5)->get($addServerToken->domain . '/?infos');
        } catch (\Throwable $th) {
            return abort(404, 'Invalid server');
        }

        $json = $response->json();

        if (Server::where('domain', $addServerToken->domain)->first()) {
            return abort(404, 'The server already exists');
        }

        $server = new Server;
        $server->domain = $addServerToken->domain;
        $server->description = $json['description'];
        $server->population = $json['population'];
        $server->connected = $json['connected'];
        $server->banner = $json['banner'];
        $server->version = $json['version'];
        $server->save();

        foreach ($json['admins'] as $admin) {
            $serverAdmin = new ServerAdmin;
            $serverAdmin->jid = $admin;
            $serverAdmin->server_id = $server->id;
            $serverAdmin->save();
        }

        foreach ($json['whitelist'] as $whitelist) {
            $serverWhitelist = new ServerWhitelist;
            $serverWhitelist->xmpp_domain = $whitelist;
            $serverWhitelist->server_id = $server->id;
            $serverWhitelist->save();
        }

        $addServerToken->used = true;
        $addServerToken->save();

        return view('servers.create_confirmation', [
            'server' => $server
        ]);
    }
}
