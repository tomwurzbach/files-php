<?php

namespace Files;

use Files\Exceptions\FileNotFoundException;
use Files\Exceptions\MethodNotAllowed;
use Files\Exceptions\UnprocessableEntityException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Files
{
    static public $apiKey;
    static public $domain;

    static public function configure( $arr )
    {
        static::$apiKey = isset( $arr['api_key'] ) ? $arr[ 'api_key' ] : '';
        static::$domain = isset( $arr['domain'] ) ? $arr[ 'domain' ] : '';
    }

    static public function get( $uri, $arr = [] )
    {
        try {
            $headers = [ 'X-FilesAPI-Key' => static::$apiKey ];
            $client = static::client();

            $response = $client->get( $uri . '.json' . http_build_query( $arr ), [ 'headers' => $headers ] );

            return json_decode( $response->getBody()->getContents(), true );
        } catch ( ClientException $e ) {
            if ( $e->getCode() == 404 ) throw new FileNotFoundException( 'get ' . $uri, $e );
            if ( $e->getCode() == 405 ) throw new MethodNotAllowed( 'get ' . $uri, $e );
            if ( $e->getCode() == 422 ) throw new UnprocessableEntityException( 'get ' . $uri, $e );
            throw $e;
        }
    }

    static public function get_simple( $uri, $arr = [] )
    {
        try {
            $headers = [ 'X-FilesAPI-Key' => static::$apiKey ];
            $client = static::client();

            $uri = $uri . '?' . http_build_query( $arr );
            $response = $client->get( $uri, [ 'headers' => $headers ] );

            return json_decode( $response->getBody()->getContents(), true );
        } catch ( ClientException $e ) {
            if ( $e->getCode() == 404 ) throw new FileNotFoundException( 'get_simple ' . $uri, $e );
            if ( $e->getCode() == 405 ) throw new MethodNotAllowed( 'get_simple ' . $uri, $e );
            if ( $e->getCode() == 422 ) throw new UnprocessableEntityException( 'get_simple ' . $uri, $e );
            throw $e;
        }
    }

    static public function post( $uri, $arr = [], $json = true )
    {
        try {
            $headers = [
                'X-FilesAPI-Key' => static::$apiKey,
                'Content-Type' => 'application/json'
            ];

            $client = static::client();
            $response = $client->post( $uri . ($json ? '.json' : ''), [ 'headers' => $headers, 'body' => json_encode( $arr ) ] );

            return json_decode( $response->getBody()->getContents(), true );
        } catch ( ClientException $e ) {
            if ( $e->getCode() == 404 ) throw new FileNotFoundException( 'post ' . $uri, $e );
            if ( $e->getCode() == 405 ) throw new MethodNotAllowed( 'post ' . $uri, $e );
            if ( $e->getCode() == 422 ) throw new UnprocessableEntityException( 'post ' . $uri, $e );
            throw $e;
        }
    }

    static protected function client()
    {
        $client = new Client( [ 'base_uri' => "https://" . static::$domain . "/api/rest/v1/" ] );
        return $client;
    }
}
