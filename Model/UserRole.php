<?php

class UserRole
{
    protected $table = 'user_roles';

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @var int
     */
    private $roleId;

    /**
     * @var int
     */
    private $userId;

    /**
     * @param datetime $createdAt
     * @param datetime $updatedAt
     * @param int $roleId
     * @param int $userId
     */
    public function __construct(
        datetime $createdAt,
        datetime $updatedAt,
        int $roleId,
        int $userId
    ) {
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->roleId = $roleId;
        $this->userId = $userId;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt(): datetime
    {
        return $this->createdAt;
    }

    /**
     * @return datetime
     */
    public function getUpdatedAt(): datetime
    {
        return $this->updatedAt;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}