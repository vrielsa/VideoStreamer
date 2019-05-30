<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function fetchByUserName(string $userName): User;

    public function fetchById(string $id): User;
}
