<?php
/**
 * Created by PhpStorm.
 * User: tomwurzbach
 * Date: 5/30/20
 * Time: 4:08 PM
 */

namespace Files\Exceptions;

class FileOrFolderExistsException extends \Exception
{
    public function __construct( $path, $previous = null )
    {
        parent::__construct( sprintf( "File exists - %s', $path ), 0, $previous );
    }
}
