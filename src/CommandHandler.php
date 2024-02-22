<?php
declare(strict_types=1);

namespace MagaBot;

use MagaBot\Commands\CommandInterface;

class CommandHandler
{
    private readonly TgBotAPI $botApi;

    /**
     * @var CommandInterface[]
     */
    private array $commands = [];

    public function __construct(TgBotAPI $botAPI)
    {
        $this->botApi = $botAPI;
    }

    public function addCommand(CommandInterface $command): void
    {
        $this->commands[] = $command;
    }

    public function handle(IncomingMessage $message): void
    {
        foreach ($this->commands as $command) {
            if ($command->canHandle($message)) {
                $command->handle($message, $this->botApi);

                return;
            }
        }

        $this->help($message->chatId);
    }

    private function help(int $chatId): void
    {
        $commandList = [];
        foreach ($this->commands as $command) {
            $commandAliases = $command->listAliases();
            array_push($commandList, ...$commandAliases);
        }

        $this->botApi->sendMessage($chatId, 'All command list: ' . implode(', ', $commandList));
    }
}
