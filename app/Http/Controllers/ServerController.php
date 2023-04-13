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

        if (!version_compare(substr($json['version'], 1), '0.21.1', '>=')) {
            return redirect()->back()->withErrors(['bad_version' => 'You need to have Movim v0.21.1 minimum']);
        }

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

    public function createConfirmation(string $token)
    {
        $addServerToken = AddServerToken::where('token', $token)->firstOrFail();

        if (Server::where('domain', $addServerToken->domain)->first()) {
            return abort(404, 'The server already exists');
        }

        $server = new Server;
        $server->requestRefresh($addServerToken->domain);

        $addServerToken->used = true;
        $addServerToken->save();

        return view('servers.create_confirmation', [
            'server' => $server
        ]);
    }
}
