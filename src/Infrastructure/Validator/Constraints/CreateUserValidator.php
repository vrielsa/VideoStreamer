<?php

declare(strict_types=1);

namespace App\Infrastructure\Validator\Constraints;

use App\Domain\Exception\UserNotFoundException;
use App\Domain\Messages\User\CreateUserMessage;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class CreateUserValidator extends ConstraintValidator
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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
        try {
            $this->userRepository->fetchByUserName($userName);
        } catch (UserNotFoundException $notFoundException) {
            return;
        }

        $this->context->buildViolation($constraint->userNameExistsMessage)
            ->setCode(CreateUser::USERNAME_EXISTS)
            ->addViolation();
    }
}
