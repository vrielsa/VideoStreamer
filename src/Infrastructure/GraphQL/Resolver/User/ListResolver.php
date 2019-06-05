<?php

declare(strict_types=1);

namespace App\Infrastructure\GraphQL\Resolver\User;

use App\Domain\Repository\UserRepositoryInterface;

class ListResolver
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function resolve(int $limit, int $offset): array
    {
        return $this->userRepository->fetchAll($limit, $offset);
    }
}
