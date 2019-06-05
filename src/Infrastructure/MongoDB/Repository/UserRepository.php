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
