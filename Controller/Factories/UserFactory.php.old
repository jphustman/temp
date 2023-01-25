<?php

use Model\User;

class UserFactory
{
//    protected static $pdo;

//    public static function setPdo(PDO $pdo)
//    {
//        self::pdo = $pdo;
//    }

    public static function getUser($id)
    {
        // return user object based on ID
    }

    public static function getUserByApiaryId($apiaryid)
    {
        // return user object based on Apiary ID
    }

    public static function create($userData)
    {
        $username = $userData['username'];
        $email = $userData['email'];
        $password = $userData['password'];
        return Database::insert("
            INSERT INTO users (
                username
                ,email
                ,password
                )
            VALUES (
                '$username'
                ,'$email'
                ,'$password'
                )        
        ");

    }

    public static function getAllUsers($limit)
    {
        // return all users but with a limit
        return Database::select("
            SELECT id
                ,username
                ,email
            FROM users
        ");
    }

    public static function getUserByUsername($userdata)
    {
        $username = $userdata['username'];
        return Database::select("
            select 
                id,
                apiaryid,
                username,
                email,
                password
            from users
            where
                username = '$username'
        ");
    }

    /*
    public static function getUsers($data)
    {
        // return user objects based on criteria in data
    }
    */
}