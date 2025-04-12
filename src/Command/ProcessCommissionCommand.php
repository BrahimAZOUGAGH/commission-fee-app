<?php

namespace App\Command;

use App\Service\OperationProcessor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessCommissionCommand extends Command
{
    protected static $defaultName = 'commission:process';

    protected function configure(): void
    {
        $this->setDescription('Processes a CSV file to calculate commissions.')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to CSV file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('file');

        $processor = new OperationProcessor();
        $results = $processor->processFile($file);

        foreach ($results as $fee) {
            $output->writeln($fee);
        }

        return Command::SUCCESS;
    }
}
