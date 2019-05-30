<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Exception\InvalidRoleException;

class UserRole
{
    private const ROLE_ADMIN = 'ROLE_ADMIN';
    private const ROLE_STANDARD_USER = 'ROLE_STANDARD_USER';

    /**
     * @var string
     */
    private $role;

    private function __construct(string $role)
    {
        if (!\in_array($role, UserRole::getAvailableRoles(), true)) {
            throw InvalidRoleException::withRole($role);
        }

        $this->role = $role;
    }

    public static function load(string $role): UserRole
    {
        return new UserRole($role);
    }

    public static function admin(): UserRole
    {
        return new UserRole(self::ROLE_ADMIN);
    }

    public static function standardUser(): UserRole
    {
        return new UserROle(self::ROLE_STANDARD_USER);
    }

    public static function getAvailableRoles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_STANDARD_USER,
        ];
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function __toString(): string
    {
        return $this->role;
    }

    public function matches(UserRole $role): bool
    {
        return $this->role === $role->getRole();
    }
}
