<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'username', 'ip', 'country_code', 'region', 'city', 'latitude', 'longitude'
    ];
}
