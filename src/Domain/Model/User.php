<?php

declare(strict_types=1);

namespace App\Domain\Model;

class User
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    private function __construct(string $id, string $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

    public static function create(
        string $id,
        string $userName
    ): User {
        return new self(
            $id,
            $userName
        );
    }

    public static function load(
        string $id,
        string $username
    ): User {
        return new self(
            $id,
            $username
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
