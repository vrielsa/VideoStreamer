<?php

declare(strict_types=1);

namespace App\Domain\Event\User;

use App\Domain\Event\DomainEvent;
use App\Domain\Model\User;

class UserCreatedEvent extends DomainEvent
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
