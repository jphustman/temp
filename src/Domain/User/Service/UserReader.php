<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserReaderResult;
use App\Domain\User\Repository\UserRepository;

/**
 * Service.
 */
final class UserReader
{
    private UserRepository $repository;

    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a user.
     *
     * @param int $userId The user id
     *
     * @return UserReaderResult The result
     */
    public function getUser(int $userId): UserReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $userRow = $this->repository->getUserById($userId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new UserReaderResult();
        $result->id = $userRow['id'];
        $result->number = $userRow['number'];
        $result->name = $userRow['name'];
        $result->street = $userRow['street'];
        $result->postalCode = $userRow['postal_code'];
        $result->city = $userRow['city'];
        $result->country = $userRow['country'];
        $result->email = $userRow['email'];

        return $result;
    }
}
