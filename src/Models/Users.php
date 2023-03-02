<?php

namespace App\Models;

class Users {
    private string $table = "users";
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
        $sql = $this->db->prepare("SELECT id, firstname, lastname, email, username, password from $this->table where username = :username");
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
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $username = $data['username'];
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

        $sql = $this->db->prepare("insert into $this->table (firstname, lastname, email, username, password) values (:firstname, :lastname, :email, :username, :password)");
        $sql->bindValue(':firstname', $firstname);
        $sql->bindValue(':lastname', $lastname);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':username', $username);
        $sql->bindValue(':password', $password);

        if ($sql->execute()) {

            $userId = $this->db->lastInsertId();
            $this->assignRole($userId, 1);

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

    public function assignRole($userId, $roleId): array
    {
        $sql = $this->db->prepare("INSERT INTO user_roles (userId, roleId) values (:userId, :roleId)");
        $sql->bindValue('userId', $userId);
        $sql->bindValue('roleId', $roleId);

        if ($sql->execute()) {
            return [
                'status' => 'Success',
                'message' => "Role assigned successfully!"
            ];
        } else {
            return [
                'status' => 'Error',
                'message' => 'Role assignment failed!'
            ];
        };
    }

    public function getRoles(int $userId): array
    {
        $sql = $this->db->prepare("SELECT name from roles where id = (select roleId FROM user_roles WHERE userId = :userId)");
        $sql->bindValue(':userId', $userId);
        $sql->execute();

        $result = $sql->fetch();
        $roles = [];
        foreach ($result as $value ) {
            $roles = array($result['name']);
        }
        return $roles;

    }

    public function updateLastLogin($id): void
    {
        $sql = $this->db->prepare("update $this->table set lastLogin = NOW() where id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
