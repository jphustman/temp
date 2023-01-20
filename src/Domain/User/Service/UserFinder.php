<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserFinderItem;
use App\Domain\User\Data\UserFinderResult;
use App\Domain\User\Repository\UserFinderRepository;

final class UserFinder
{
    private UserFinderRepository $repository;

    public function __construct(UserFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findUsers(): UserFinderResult
    {
        // Input validation
        // ...

        $users = $this->repository->findUsers();

        return $this->createResult($users);
    }

    private function createResult(array $userRows): UserFinderResult
    {
        $result = new UserFinderResult();

        foreach ($userRows as $userRow) {
            $user = new UserFinderItem();
            $user->id = $userRow['id'];
            $user->number = $userRow['number'];
            $user->name = $userRow['name'];
            $user->street = $userRow['street'];
            $user->postalCode = $userRow['postal_code'];
            $user->city = $userRow['city'];
            $user->country = $userRow['country'];
            $user->email = $userRow['email'];

            $result->users[] = $user;
        }

        return $result;
    }
}
