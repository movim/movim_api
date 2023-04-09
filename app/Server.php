<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
