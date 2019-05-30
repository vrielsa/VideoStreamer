<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

class FixturesRunner implements FixtureInterface
{
    /**
     * @var FixtureInterface[]
     */
    private $fixtures = [];

    public function __construct(iterable $fixtures)
    {
        foreach ($fixtures as $fixture) {
            $this->addFixture($fixture);
        }
    }

    private function addFixture(FixtureInterface $fixture): void
    {
        $this->fixtures[] = $fixture;
    }

    public function execute(): iterable
    {
        foreach ($this->fixtures as $fixture) {
            yield from $fixture->execute();
        }
    }
}
