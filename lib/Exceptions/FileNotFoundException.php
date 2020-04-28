<?php

namespace Files\Exceptions;

class FileNotFoundException extends \Exception
{
    protected $contents;

    public function __construct( $msg, $exception )
    {
        parent::__construct( $msg, 0, $exception );
        $this->contents = json_decode( $exception->getResponse()->getBody()->getContents(), true );
    }

    public function getContents()
    {
        return $this->contents;
    }
}
