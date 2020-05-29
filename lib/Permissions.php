<?php

namespace Files;

class Permissions
{
    public static function list( $arr )
    {
        $permissions = Files::get( 'permissions', $arr );
        return $permissions;
    }

    public static function create( $path, $arr )
    {
        $permission = Files::post( 'permissions', array_merge( [ 'path' => $path, $arr ] );
        return $permission;
    }

    public static function delete( $id )
    {
        Files::delete( 'permissions/{$id}' );
    }
}
