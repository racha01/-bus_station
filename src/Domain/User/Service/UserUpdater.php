<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class UserUpdater
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserValidator
     */
    private $userValidator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     * @param UserValidator $userValidator The validator
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(
        UserRepository $repository,
        UserValidator $userValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->userValidator = $userValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('user_updater.log')
            ->createInstance();
    }

    /**
     * Update user.
     *
     * @param int $userId The user id
     * @param array<mixed> $data The request data
     *
     * @return void
     */
    public function updateUser(int $userId, array $data): void
    {
        $this->userValidator->validateUserUpdate($userId, $data);

        $userRow = $this->mapToRow($data);

        $this->repository->updateUser($userId, $userRow);

        $this->logger->info(sprintf('User updated successfully: %s', $userId));
    }

    public function insertUser( array $data): int
    {
        $this->userValidator->validateUserInsert($data);

        $Row = $this->mapToRow($data);

        $id=$this->repository->insertUser($Row);

        return $id;
    }

    /**
     * Map data to row.
     *
     * @param array<mixed> $data The data
     *
     * @return array<mixed> The row
     */
    private function mapToRow(array $data): array
    {
        $result = [];

        if (isset($data['name'])) {
            $result['name'] = $data['name'];
        }
        if (isset($data['username'])) {
            $result['username'] = $data['username'];
        }

        if (isset($data['password']) && $data['password']!='') {
            $result['password'] = $data['password'];
        }

        if (isset($data['email'])) {
            $result['email'] = $data['email'];
        }

        if (isset($data['phone'])) {
            $result['phone'] = $data['phone'];
        }

        return $result;
    }
}
