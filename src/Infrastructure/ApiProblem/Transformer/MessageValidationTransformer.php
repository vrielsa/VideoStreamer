<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiProblem\Transformer;

use Phpro\ApiProblem\ApiProblemInterface;
use Phpro\ApiProblem\Http\ValidationApiProblem;
use Phpro\ApiProblemBundle\Transformer\ExceptionTransformerInterface;
use Symfony\Component\Messenger\Exception\ValidationFailedException;

class MessageValidationTransformer implements ExceptionTransformerInterface
{
    /**
     * @param ValidationFailedException $exception
     */
    public function transform(\Throwable $exception): ApiProblemInterface
    {
        return new ValidationApiProblem($exception->getViolations());
    }

    public function accepts(\Throwable $exception): bool
    {
        return $exception instanceof ValidationFailedException;
    }
}
