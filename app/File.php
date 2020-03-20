<?php

namespace App;

use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class File extends Model
{
    public $name;
    public $uri;
    public $mtime;
    public $size;
    public $formatedSize;
    public $type;

    public function __construct(string $path)
    {
        $this->name = basename($path);
        $this->uri = config('app.ejabberd_upload_base').str_replace(config('app.ejabberd_upload_path'), '', $path);
        $this->mtime = new Carbon(filemtime($path));
        $this->size = filesize($path);
        $this->formatedSize = Utils::sizeToCleanSize($this->size);
        $this->type = filetype($path);
    }
}
