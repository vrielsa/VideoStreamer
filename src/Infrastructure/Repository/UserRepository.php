<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Exception\UserNotFoundException;
use App\Domain\Model\User;
use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function save(User $user): void
    {
        $this->documentManager->persist($user);
        $this->documentManager->flush($user);
    }

    public function fetchByUserName(string $userName): User
    {
        $user = $this->documentManager->getRepository(User::class)
            ->findOneBy(
                ['username' => $userName]
            );

        if (!$user) {
            throw UserNotFoundException::withUserName($userName);
        }

        return $user;
    }

    public function fetchById(string $id): User
    {
        $user = $this->documentManager->find(User::class, $id);

        if (!$user) {
            throw UserNotFoundException::withId($id);
        }

        return $user;
    }
}
