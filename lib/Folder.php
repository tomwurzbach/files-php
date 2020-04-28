<?php

namespace Files;


class Folder
{
    static public function create( $path )
    {
        $path = Files::post( 'folders/' . $path, [], false );
        return $path;
    }

    static public function listFor( $path, $arr = [] )
    {
        $files = Files::get_simple( 'folders/'. $path, $arr );
        return $files;
    }
}

