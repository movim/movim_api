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

    public function getFiles()
    {
        $path = config('app.ejabberd_upload_path');
        $files = glob($path.'/'.sha1($this->jid).'/*/*');
        $resolvedFiles = [];

        foreach ($files as $file) {
            array_push($resolvedFiles, new File($file));
        }

        return $resolvedFiles;
    }
}
