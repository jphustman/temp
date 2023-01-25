<?php

namespace Model;
use Exception;

class User
{
    protected $table = 'users';

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var int|null
     */
    private $apiaryId;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $role;


    /**
     * @param int|null $id
     * @param int|null $apiaryId
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $role
     */
    public function __construct(
        ?int $id = null,
        ?int $apiaryId = null,
        string $username = "",
        string $email = "",
        string $password = "",
        string $role = ""
    ) {
        $this->id = $id;
        $this->apiaryId = $apiaryId;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    // Getters {

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getApiaryId(): ?int
    {
        return $this->apiaryId;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }
    // }

    // Setters {

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int|null $apiaryId
     * @return void
     */
    public function setApiaryId(?int $apiaryId): void
    {
        $this->apiaryId = $apiaryId;
    }

    /**
     * @param string $username
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string $email
     * @return void
     * @throws Exception
     */
    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address");
        }
        $this->email = $email;
    }

    /**
     * @param string $password
     * @return void
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return void
     */
    public function save(): void
    {
        if ($this->id) {
            $query = "
                UPDATE {$this->table}
                SET
                    apiaryid = :apiaryId,
                    username = :username,
                    email = :email,
                    password = :password,
                    role = :role
                WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id', $this->id);
        } else {
            $query = "
                INSERT INTO {$this->table}
                    (apiaryid, username, email, password, role)
                VALUES
                    (:apiaryId, :username, :email, :password, :role)";
            $stmt = $this->pdo->prepare($query);
        }

        $stmt->bindValue(':apiaryId', $this->apiaryId);
        $stmt->bindValue(':username', $this->username);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':password', $this->password);
        $stmt->bindValue(':role', $this->role);

        $stmt->execute();

        if (!$this->id) {
            $this->id = $this->pdo->lastInsertId();
        }
    }

    /**
     * Load the user from the database
     * @param int $id
     * @return User|null
     */
    public static function load(PDO $pdo, int $id): ?self
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new self(
            $pdo,
            $data['id'],
            $data['apiaryid'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['role']);
    }

    // }

}