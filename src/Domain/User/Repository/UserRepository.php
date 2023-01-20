<?php

namespace App\Domain\User\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class UserRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function insertUser(array $user): int
    {
        return (int)$this->queryFactory->newInsert('users', $this->toRow($user))
            ->execute()
            ->lastInsertId();
    }

    public function getUserById(int $userId): array
    {
        $query = $this->queryFactory->newSelect('users');
        $query->select(
            [
                'id',
                'number',
                'name',
                'street',
                'postal_code',
                'city',
                'country',
                'email',
            ]
        );

        $query->where(['id' => $userId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('User not found: %s', $userId));
        }

        return $row;
    }

    public function updateUser(int $userId, array $user): void
    {
        $row = $this->toRow($user);

        $this->queryFactory->newUpdate('users', $row)
            ->where(['id' => $userId])
            ->execute();
    }

    public function existsUserId(int $userId): bool
    {
        $query = $this->queryFactory->newSelect('users');
        $query->select('id')->where(['id' => $userId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteUserById(int $userId): void
    {
        $this->queryFactory->newDelete('users')
            ->where(['id' => $userId])
            ->execute();
    }

    private function toRow(array $user): array
    {
        return [
            'number' => $user['number'],
            'name' => $user['name'],
            'street' => $user['street'],
            'postal_code' => $user['postal_code'],
            'city' => $user['city'],
            'country' => $user['country'],
            'email' => $user['email'],
        ];
    }
}
