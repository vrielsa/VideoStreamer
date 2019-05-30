<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Domain\Messages\User\CreateUserMessage;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * TESTING CONTROLLER - WILL BE REMOVED SOON.
 *
 * @deprecated DO NOT USE
 */
class DefaultController
{
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): Response
    {
        $data = new ParameterBag((array) json_decode($request->getContent(), true));

        $this->messageBus->dispatch(
            new CreateUserMessage(
                Uuid::uuid4()->toString(),
                $data->get('username', ''),
                $data->get('email', '')
            )
        );

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
