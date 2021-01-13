<?php

namespace App\Libraries;

class StringPrep
{
    public static function resolve(string $string): string
    {
        return exec('export LANG=C.UTF-8 && idn -s  -p Nodeprep '.escapeshellarg($string));
    }
}