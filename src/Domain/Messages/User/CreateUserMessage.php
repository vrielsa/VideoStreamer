<?php

declare(strict_types=1);

namespace App\Domain\Messages\User;

class CreateUserMessage
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    public function __construct(
        string $id,
        string $username
    ) {
        $this->id = $id;
        $this->username = $username;
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
