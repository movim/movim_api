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

    public function requestRefresh(string $domain): ?string
    {
        try {
            $response = Http::timeout(5)->get('https://' . $domain . '/infos');
        } catch (\Throwable $th) {
            return 'Invalid server ' . $domain;
        }

        $json = $response->json();

        if (!is_array($json)) {
            return 'Invalid JSON ' . $domain;
        }

        $this->domain = $domain;
        $this->description = (string)$json['description'];
        $this->population = (int)$json['population'];
        $this->connected = (int)$json['connected'];
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

        return null;
    }
}
