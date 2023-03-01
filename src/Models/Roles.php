<?php

namespace App\Models;

class Roles {
    private $table = "roles";
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

    public function getByName($name) {
        $sql = $this->db->prepare("SELECT id, name, createdAt, updatedAt from $this->table where name = :name");
        $sql->bindValue(':name', $name);
        $sql->execute();

        return $sql->fetch();
    }

    public function create(array $data): array
    {
        $role = $data['role'];

        // Check if name already exists
        $existingRole = $this->getByRole($role);
        if ($existingRole) {
            return [
                'status' => 'Error',
                'message' => 'Role already exists!',
            ];
        }

        $sql = $this->db->prepare("insert into $this->table (role) values (:role)");
        $sql->bindValue(':role', $data['role']);

        if ($sql->execute()) {
            return [
                'status' => 'Success',
                'message' => 'Role created successfully!'
            ];
        } else {
            return [
                'status' => 'Error',
                'message' => 'Role creation failed!'
            ];
        };
    }
}
