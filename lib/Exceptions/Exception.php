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

        $this->contents = json_decode( $exception->getResponse()->getBody()->getContents(), true );

        $message = $exception->getPrevious()->getMessage();
        $parts = explode( "\n", $message );
        if ( sizeof( $parts ) >= 2 ) {

            $json = collect( json_decode( $parts[ 1 ], true ) );
            $this->error = $json->get( 'error' );
        }
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function getError()
    {
        return $this->error;
    }

}
