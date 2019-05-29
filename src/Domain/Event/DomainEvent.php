<?php

declare(strict_types=1);

namespace App\Domain\Event;

use Symfony\Component\EventDispatcher\Event;

abstract class DomainEvent extends Event implements DomainEventInterface
{
}
