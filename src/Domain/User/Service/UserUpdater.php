<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class UserUpdater
{
    private UserRepository $repository;

    private UserValidator $userValidator;

    private LoggerInterface $logger;

    public function __construct(
        UserRepository $repository,
        UserValidator  $userValidator,
        LoggerFactory  $loggerFactory
    ) {
        $this->repository = $repository;
        $this->userValidator = $userValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('user_updater.log')
            ->createLogger();
    }

    public function updateUser(int $userId, array $data): void
    {
        // Input validation
        $this->userValidator->validateUserUpdate($userId, $data);

        // Update the row
        $this->repository->updateUser($userId, $data);

        // Logging
        $this->logger->info(sprintf('User updated successfully: %s', $userId));
    }
}
