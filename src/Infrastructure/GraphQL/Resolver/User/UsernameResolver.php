<?php

declare(strict_types=1);

namespace App\Infrastructure\GraphQL\Resolver\User;

use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;

class UsernameResolver
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function resolve(string $username): User
    {
        return $this->userRepository->fetchByUsername($username);
    }
}
