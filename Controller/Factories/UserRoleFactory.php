<?php

use Model\UserRoles;

class UserRoleFactory
{
//    protected static $pdo;

//    public static function setPdo(PDO $pdo)
//    {
//        self::pdo = $pdo;
//    }

    public static function getUserRole($username)
    {
        return Database::select("
            select `name` from roles where id = (
                select `roleId` from user_roles where userid = (
                    select `id` from users where username = '$username'
                )
            )
        ");
    }

    public static function setUserRole($roleId, $userId)
    {
        return Database::insert("
            insert into user_roles (roleId, userId) values ('$roleId', '$userId')
        ");
    }



}