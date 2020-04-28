<?php

namespace Files;


class File
{
    public static function find( $id, $arr = [] )
    {
        $arr || $arr = [];
        $arr[ 'id' ] = $id;

        $file = Files::get_simple( 'files/', $arr, false );
        return $file;
    }
}
