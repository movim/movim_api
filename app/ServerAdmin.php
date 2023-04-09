<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerAdmin extends Model
{
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
