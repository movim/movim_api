<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Server extends Model
{
    protected $with = ['admins', 'whitelist'];

    public function admins()
    {
        return $this->hasMany(ServerAdmin::class);
    }

    public function whitelist()
    {
        return $this->hasMany(ServerWhitelist::class);
    }

    public function requestRefresh(string $domain)
    {
        try {
            $response = Http::timeout(5)->get($domain . '/?infos');
        } catch (\Throwable $th) {
            return abort(404, 'Invalid server');
        }

        $json = $response->json();

        $this->domain = $domain;
        $this->description = $json['description'];
        $this->population = $json['population'];
        $this->connected = $json['connected'];
        $this->banner = $json['banner'];
        $this->version = $json['version'];
        $this->save();

        $this->admins()->delete();
        $this->whitelist()->delete();

        foreach ($json['admins'] as $admin) {
            $serverAdmin = new ServerAdmin;
            $serverAdmin->jid = $admin;
            $serverAdmin->server_id = $this->id;
            $serverAdmin->save();
        }

        foreach ($json['whitelist'] as $whitelist) {
            $serverWhitelist = new ServerWhitelist;
            $serverWhitelist->xmpp_domain = $whitelist;
            $serverWhitelist->server_id = $this->id;
            $serverWhitelist->save();
        }
    }
}
