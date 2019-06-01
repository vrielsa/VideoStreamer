<?php

declare(strict_types=1);

namespace App\Infrastructure\MongoDB\Mapper;

use App\Domain\Collection\User\UserRoleCollection;
use App\Domain\Model\User\UserRole;
use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Types\Type;

class UserRoleMapper extends Type
{
    private const NAME = 'UserRole';

    /**
     * @param UserRoleCollection $value
     */
    public function convertToDatabaseValue($value): array
    {
        if (null === $value && !$value instanceof UserRoleCollection) {
            throw MongoDBException::invalidValueForType('UserRole', [UserRoleCollection::class, 'null'], $value);
        }

        return null !== $value ? array_values($value->toArray()) : [];
    }

    public function convertToPHPValue($value): UserRoleCollection
    {
        if (!$value || empty($value)) {
            return new UserRoleCollection();
        }

        $roles = array_values($value);
        $roleCollection = new UserRoleCollection();

        foreach ($roles as $role) {
            $roleCollection->add(UserRole::load($role));
        }

        return $roleCollection;
    }

    public function closureToPHP()
    {
        return sprintf('
            $type = \%s::getType($typeIdentifier);
            $return = $type->convertToPHPValue($value);', self::class);
    }

    public static function getName(): string
    {
        return self::NAME;
    }
}
