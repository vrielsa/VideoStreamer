<?php

declare(strict_types=1);

namespace App\Infrastructure\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class CreateUser extends Constraint
{
    public const USERNAME_EXISTS = '23bd9dbf-6b9b-41cd-a99e-4844bcf31245';

    protected static $errorNames = [
        CreateUser::USERNAME_EXISTS => 'USERNAME_EXISTS',
    ];

    public $userNameExistsMessage = 'The given username already exists.';

    public function getTargets(): array
    {
        return [
            self::CLASS_CONSTRAINT,
        ];
    }
}
