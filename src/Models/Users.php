<?php

namespace App\Models;

class Users {
    private $table = "users";
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getById($id) {
        $sql = $this->db->prepare("select * from $this->table where id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();

        return $sql->fetch();
    }

    public function getByLogin($data) {
        $sql = $this->db->prepare("select * from $this->table where password = :login");
        $sql->bindValue(':login', $data['password']);
        $sql->execute();

        return $sql->fetch();
    }

    public function getByUsername($username) {
        $sql = $this->db->prepare("SELECT id from $this->table where username = :username");
        $sql->bindValue(':username', $username);
        $sql->execute();

        return $sql->fetch();
    }

    public function getByEmail($email) {
        $sql = $this->db->prepare("SELECT id from $this->table where email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        return $sql->fetch();
    }
    public function create(array $data): array
    {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];

        // Check if username already exists
        $existingUsername = $this->getByUsername($username);
        if ($existingUsername) {
            return [
                'status' => 'Error',
                'message' => 'Username already registered!',
            ];
        }

        // Check if email already exists
        $existingEmail = $this->getByEmail($email);
        if ($existingEmail) {
            return [
                'status' => 'Error',
                'message' => 'Email already registered!',
            ];
        }

        $sql = $this->db->prepare("insert into $this->table (username, email, password) values (:username, :email, :password)");
        $sql->bindValue(':username', $data['username']);
        $sql->bindValue(':email', $data['email']);
        $sql->bindValue(':password', $data['password']);

        if ($sql->execute()) {
            return [
                'status' => 'Success',
                'message' => 'User created successfully!'
            ];
        } else {
            return [
                'status' => 'Error',
                'message' => 'User creation failed!'
            ];
        };
    }

    public function updateLastLogin($id) {
        $sql = $this->db->prepare("update $this->table set last = NOW() where id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
