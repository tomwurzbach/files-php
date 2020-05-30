<?php

namespace Files;


use Files\Exceptions\FileOrFolderExistsException;
use Files\Exceptions\MethodNotAllowed;

class Folder
{
    static public function create( $path )
    {
        try {
            $path = Files::post( 'folders/' . $path, [], false );
            return $path;
        } catch ( MethodNotAllowed $e ) {
            $message = $e->getMessage();
            $parts = explode( "\n", $message );
            if ( sizeof( $parts ) < 2 ) throw $e );

            $json = collect( json_decode( $parts[ 1 ], true ) );
            if ( $json->get( 'error' ) == 'file or folder already exists with that name' ) throw new FileOrFolderExistsException( $path, $e );
            throw $e;
        }
    }

    static public function listFor( $path, $arr = [] )
    {
        $files = Files::get_simple( 'folders/' . $path, $arr );
        return $files;
    }
}

