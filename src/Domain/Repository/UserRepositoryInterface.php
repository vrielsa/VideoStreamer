<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\User\User;

interface UserRepositoryInterface
{
    public function create(User $user): void;

    public function fetchByUsername(string $userName): User;

    public function fetchById(string $id): User;

    public function fetchAll(int $limit, int $offset): array;

    public function drop(): void;
}
