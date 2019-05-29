<?php

declare(strict_types=1);

namespace App\Domain\Messages\Handler\User;

use App\Domain\Event\User\UserCreatedEvent;
use App\Domain\Messages\User\CreateUserMessage;
use App\Domain\Model\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateUserMessageHandler implements MessageHandlerInterface
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    public function __construct(
        DocumentManager $documentManager,
        EventDispatcher $eventDispatcher
    ) {
        $this->documentManager = $documentManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(CreateUserMessage $message): void
    {
        $user = User::create(
            $message->getId(),
            $message->getUsername()
        );

        $this->documentManager->persist($user);
        $this->documentManager->flush($user);
        $this->eventDispatcher->dispatch(UserCreatedEvent::class, new UserCreatedEvent($user));
    }
}
