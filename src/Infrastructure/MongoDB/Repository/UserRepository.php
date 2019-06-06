<?php

declare(strict_types=1);

namespace App\Infrastructure\MongoDB\Repository;

use App\Domain\Exception\UserNotFoundException;
use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\MongoDB\Mapper\UserRoleMapper;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Types\Type;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
        $this->addCustomMappingTypes();
    }

    public function create(User $user): void
    {
        $this->documentManager->persist($user);
        $this->documentManager->flush($user);
    }

    public function fetchByUsername(string $username): User
    {
        $user = $this->documentManager->getRepository(User::class)
            ->findOneBy(
                ['username' => $username]
            );

        if (!$user) {
            throw UserNotFoundException::withUsername($username);
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

    /**
     * @return User[]
     */
    public function fetchAll(int $limit, int $offset): array
    {
        $documents = $this->documentManager
            ->createQueryBuilder(User::class)
            ->limit($limit)
            ->skip($offset)
            ->getQuery()
            ->execute()
            ->toArray();

        return array_map(function (User $user) {
            return $user;
        }, $documents);
    }

    public function drop(): void
    {
        $this->documentManager->getDocumentCollection(User::class)->drop();
    }

    private function addCustomMappingTypes(): void
    {
        if (Type::hasType(UserRoleMapper::getName())) {
            return;
        }

        Type::addType(UserRoleMapper::getName(), UserRoleMapper::class);
    }
}
