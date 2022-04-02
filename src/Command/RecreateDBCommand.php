<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:db:schema:recreate',
    description: 'Recreate db schema.',
    hidden: false
)]
class RecreateDBCommand extends Command {
    protected function execute(InputInterface $input, OutputInterface $output): int {
        $commands = [
            ['name' => 'doctrine:schema:drop', 'args' => ['--force' => true]],
            ['name' => 'doctrine:schema:update', 'args' => ['--force' => true]],
            ['name' => 'doctrine:fixtures:load'],
        ];

        foreach ($commands as $command) {
            $command = $this->sendCommand($command['name'], $command['args'] ?? null);
            $comm = $command['command'];
            $responseCode = $comm->run($command['input'], $output);

            if (Command::SUCCESS !== $responseCode) {
                return Command::FAILURE;
            }
        }

        return Command::SUCCESS;
    }

    private function sendCommand(string $commandName, ?array $args = []): array
    {
        $command = $this->getApplication()->find($commandName);

        $args['command'] = $commandName;
        $input = new ArrayInput($args);
        $input->setInteractive(false);

        return [
            'command' => $command,
            'input' => $input,
        ];
    }
}
