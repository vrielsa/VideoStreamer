<?php

declare(strict_types=1);

namespace App\Domain\Collection\User;

use App\Domain\Model\User\UserRole;
use Countable;
use Doctrine\MongoDB\ArrayIterator;
use IteratorAggregate;

class UserRoleCollection implements IteratorAggregate, Countable
{
    /**
     * @var UserRole[]
     */
    private $userRoles;

    public function __construct(UserRole ...$userRoles)
    {
        $this->userRoles = $userRoles;
    }

    public static function load(array $userRoles): UserRoleCollection
    {
        return new UserRoleCollection(...array_map(static function ($userRole) {
            return UserRole::load($userRole);
        }, $userRoles));
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->userRoles);
    }

    public function count(): int
    {
        return \count($this->userRoles);
    }

    public function add(UserRole $userRole): void
    {
        $this->userRoles[] = $userRole;
    }

    public function merge(UserRoleCollection ...$collections): self
    {
        foreach ($collections as $collection) {
            foreach ($collection as $role) {
                $this->add($role);
            }
        }

        return $this;
    }

    public function map(callable $callable): array
    {
        return array_map($callable, $this->userRoles);
    }

    public function toArray(): array
    {
        return array_values(array_unique($this->map(static function (UserRole $role): string {
            return $role->getRole();
        })));
    }
}
