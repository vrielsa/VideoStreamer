<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class UserNotFoundException extends \RuntimeException
{
    public static function withId(string $id): UserNotFoundException
    {
        return new self(
            sprintf('The user with ID: %s could not be found', $id)
        );
    }

    public static function withUsername(string $username): UserNotFoundException
    {
        return new self(
            sprintf('The user with username: %s could not be found.', $username)
        );
    }
}
