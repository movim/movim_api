<?php

namespace App;

class Account extends Authenticatable
{
    protected $fillable = [
        'username', 'ip', 'country_code', 'region', 'city', 'latitude', 'longitude'
    ];
}
