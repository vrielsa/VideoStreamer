<?php

declare(strict_types=1);

namespace App\Infrastructure\Validator\Constraints;

use App\Domain\Messages\User\CreateUserMessage;
use App\Domain\Model\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class CreateUserValidator extends ConstraintValidator
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof CreateUser) {
            throw new UnexpectedTypeException($constraint, CreateUser::class);
        }

        if (!$value instanceof CreateUserMessage) {
            throw new UnexpectedValueException($value, CreateUserMessage::class);
        }

        $this->validateUniqueUsername($value->getUsername(), $constraint);
    }

    private function validateUniqueUsername(string $userName, CreateUser $constraint): void
    {
        $user = $this->documentManager->getRepository(User::class)->findOneBy(
            ['username' => $userName]
        );

        if (!$user) {
            return;
        }

        $this->context->buildViolation($constraint->userNameExistsMessage)
            ->setCode(CreateUser::USERNAME_EXISTS)
            ->addViolation();
    }
}
