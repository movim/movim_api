<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    protected $fillable = [
        'username', 'ip', 'country_code', 'region', 'city', 'latitude', 'longitude'
    ];

    public function getJidAttribute()
    {
        return $this->attributes['username'] . '@' . $this->attributes['domain'];
    }
}
