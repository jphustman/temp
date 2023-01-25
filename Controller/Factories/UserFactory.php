<?php

use Model\User as User;

class UserFactory
{
    /**
     * UserFactory constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param int $id
     * @return User|null
     */
    public static function getById(int $id)
    {
        return Database::select("
            SELECT * FROM users WHERE id = :id 
        ");
    }



    /**
     * @param int $apiaryId
     * @return User|null
     */
    public static function getByApiaryId(int $apiaryId): ?User
    {
        return Database::select("
            SELECT * FROM users WHERE apiaryid = :apiaryId 
        ");
    }

    /**
     * @param string $username
     * @return User|null
     */
    public static function getByUsername(string $username): ?User
    {
        $stmt = Database::select("SELECT * FROM users WHERE username = '$username'");

        if ($stmt) {
            return new User($stmt[0]['id'], $stmt[0]['apiaryid'], $stmt[0]['username'], $stmt[0]['email'], $stmt[0]['password']);
        }
        return null;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public static function getByEmail(string $email): ?User
    {
        $stmt = Database::select("SELECT * FROM users WHERE email = '$email'");

        if ($stmt) {
            return new User($stmt[0]['id'], $stmt[0]['apiaryid'], $stmt[0]['username'], $stmt[0]['email'], $stmt[0]['password']);
        }
        return null;
    }

    /**
     * @param array $data
     * @return User
     */
    public static function create(array $userData): User
    {
        // need to set up validation checks here

        $username = $userData['username'];
        $email = $userData['username'];
        $password = $userData['password'];

        $stmt = Database::insert("
            INSERT INTO users (
                username
                ,email
                ,password
                )
            VALUES (
                '$username',
                '$email',
                '$password'
                )        
        ");

        if ($stmt) {
            return new User($stmt, 0, $userData['username'], $userData['email'], $userData['password']);
        }
    }

}