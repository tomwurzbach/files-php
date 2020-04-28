<?php

namespace Files;

class Users
{
    public static function list( $arr )
    {
        $users = Files::get( 'users', $arr );
        return $users;
    }

    public static function find( $id )
    {
        $user = Files::get( "users/{$id}" );
        return $user;
    }

    public static function create( $arr )
    {
        $user = Files::post( 'users', $arr );
        return $user;
    }
}
