<?php
/**
 * Created by PhpStorm.
 * User: tomwurzbach
 * Date: 6/1/20
 * Time: 3:12 PM
 */

namespace Files\Exceptions;


class Exception extends \Exception
{
    protected $contents;
    protected $error;

    public function __construct( $msg, $exception )
    {
        parent::__construct( $msg, 0, $exception );

        $this->contents = collect( json_decode( $exception->getResponse()->getBody()->getContents(), true ) );
        $this->error = $this->contents->get( 'error' );
        $this->errors = $this->contents->get( 'errors' );
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
