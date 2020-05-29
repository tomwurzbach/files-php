<?php

namespace Files;

class Users
{
    public static function list( $arr )
    {
        $behaviors = Files::get( 'behaviors', $arr );
        return $users;
    }

    public static function listFor( $path, $arr )
    {
        $behaviors = Files::get( "behaviors/folders/{$path}" );
        return $behaviors;
    }

    public static function create( $arr )
    {
        $behavior = Files::post( 'behaviors', $arr );
        return $behavior;
    }
}