<?php

namespace Files;


class File
{
    public static function find( $path, $arr = [] )
    {
        $file = Files::get_simple( 'files/' . $path, $arr, false );
        return $file;
    }
}
