<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Domain\Model\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    public function __construct(DocumentManager $mongoDbManager)
    {
        $this->documentManager = $mongoDbManager;
    }

    public function index()
    {
        $user = new User();
        $user->setId(Uuid::uuid4()->toString());
        $user->setUsername('sarah');

        $this->documentManager->persist($user);
        $this->documentManager->flush();

        return new JsonResponse(['hey']);
    }
}
