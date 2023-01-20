<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;

final class UserDeleter
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteUser(int $userId): void
    {
        // Input validation
        // ...

        $this->repository->deleteUserById($userId);
    }
}
