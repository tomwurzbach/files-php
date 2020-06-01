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
            if ( $e->getError() == 'file or folder already exists with that name' )
                throw new FileOrFolderExistsException( "File or folder exists", $e->getPrevious() );

            throw $e;
        }
    }

    static public function listFor( $path, $arr = [] )
    {
        $files = Files::get_simple( 'folders/' . $path, $arr );
        return $files;
    }
}

