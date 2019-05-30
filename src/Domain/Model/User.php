<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Collection\UserRoleCollection;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var UserRoleCollection
     */
    private $roles;

    /**
     * @var string
     */
    private $email;

    /**
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
