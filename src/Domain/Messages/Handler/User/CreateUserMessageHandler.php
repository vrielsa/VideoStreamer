<?php

declare(strict_types=1);

namespace App\Domain\Messages\Handler\User;

use App\Domain\Event\User\UserCreatedEvent;
use App\Domain\Messages\User\CreateUserMessage;
use App\Domain\Model\User;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateUserMessageHandler implements MessageHandlerInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(CreateUserMessage $message): void
    {
        $user = User::create(
            $message->getId(),
            $message->getUsername()
        );

        $this->userRepository->save($user);
        $this->eventDispatcher->dispatch(UserCreatedEvent::class, new UserCreatedEvent($user));
    }
}
