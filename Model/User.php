<?php

namespace Model;

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
        ?int $id,
        ?int $apiaryId,
        string $username,
        string $email,
        string $password,
        string $role
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
    public function getApiaryId(): int
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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setApiaryId($apiaryId)
    {
        $this->apiaryId = $apiaryId;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    // }

}