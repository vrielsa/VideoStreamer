<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

interface FixtureInterface
{
    public function execute(): iterable;
}
