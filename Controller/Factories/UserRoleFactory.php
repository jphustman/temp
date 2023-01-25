<?php

use Model\UserRoles;

class UserRoleFactory
{

    public static function getUserRoles($userid)
    {
        return Database::select("
            SELECT roles.name FROM roles JOIN user_roles ON roles.id = user_roles.roleId 
WHERE user_roles.userId = '$userid'
        ");
    }

    public static function setUserRole($roleId, $userId)
    {
        return Database::insert("
            insert into user_roles (roleId, userId) values ('$roleId', '$userId')
        ");
    }


}