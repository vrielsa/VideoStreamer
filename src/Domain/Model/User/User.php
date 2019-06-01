<?php

declare(strict_types=1);

namespace App\Domain\Model\User;

use App\Domain\Collection\User\UserRoleCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @MongoDB\Document(collection="users")
 */
class User implements UserInterface
{
    /**
     * @MongoDB\Id(type="string", strategy="NONE")
     *
     * @var string
     */
    private $id;

    /**
     * @MongoDB\Field(type="string")
     *
     * @var string
     */
    private $username;

    /**
     * @MongoDB\Field(type="UserRole")
     *
     * @var UserRoleCollection
     */
    private $roles;

    /**
     * @MongoDB\Field(type="string")
     *
     * @var string
     */
    private $email;

    /**
     * @MongoDB\Field(type="string")
     *
     * @var string
     */
    private $password;

    public static function create(
        string $id,
        string $username,
        string $email
    ): User {
        $user = new self();
        $user->id = $id;
        $user->username = $username;
        $user->email = $email;
        $user->password = '';
        $user->roles = new UserRoleCollection();

        return $user;
    }

    public static function load(
        string $id,
        string $username,
        string $email,
        string $password,
        UserRoleCollection $userRoleCollection
    ): User {
        $user = new self();
        $user->id = $id;
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        $user->roles = $userRoleCollection;

        return $user;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return $this->roles->toArray();
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }
}
