<?php

declare(strict_types=1);

namespace App\Infrastructure\Console\Command;

use App\Infrastructure\Fixtures\FixturesRunner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FixturesCommand extends Command
{
    /**
     * @var FixturesRunner
     */
    private $fixturesRunner;

    public function __construct(FixturesRunner $fixturesRunner)
    {
        parent::__construct();
        $this->fixturesRunner = $fixturesRunner;
    }

    protected function configure(): void
    {
        $this->setDescription('Load app fixtures');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        foreach ($this->fixturesRunner->execute() as $fixture) {
            $io->text(sprintf('Imported %s', get_class($fixture)));
        }

        $io->success('Imported fixtures');

        return 0;
    }
}
