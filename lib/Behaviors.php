<?php

namespace Files;

class Behaviors
{
    public static function list( $arr )
    {
        $behaviors = Files::get( 'behaviors', $arr );
        return $behaviors;
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
