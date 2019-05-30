<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class InvalidRoleException extends \RuntimeException
{
    public static function withRole(string $role): InvalidRoleException
    {
        return new self(sprintf('The given role: %s, is not valid.', $role));
    }
}
