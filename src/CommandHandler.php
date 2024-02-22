<?php
declare(strict_types=1);

namespace MagaBot;

class CommandHandler
{
    private readonly TgBotAPI $botApi;
    private array $trueCommand;

    public function __construct(TgBotAPI $botAPI)
    {
        $this->botApi = $botAPI;
        $this->trueCommand['!show date'] = 'showDate';
        $this->trueCommand['!show time'] = 'showTime';
        $this->trueCommand['!show content'] = 'showContent';
        $this->trueCommand['!help'] = 'help';
    }

    public function handle(IncomingMessage $command): void
    {
        if (!isset($this->trueCommand[$command->text])) {
            $this->botApi->sendMessage(
                $command->chatId,
                'Unknown command. Write !help to see list of available commands.'
            );

            return;
        }

        $this->{$this->trueCommand[$command->text]}($command);
    }

    private function showDate(IncomingMessage $command): void
    {
        $this->botApi->sendMessage($command->chatId, date('d.m.Y'));
    }

    private function showTime(IncomingMessage $command): void
    {
        $this->botApi->sendMessage($command->chatId, date('H:i'));
    }

    private function showContent(IncomingMessage $command): void
    {
        $picture = __DIR__ . '/../images/pepe.webp';

        $this->botApi->sendPhoto($command->chatId, $picture);
    }

    private function help(IncomingMessage $command): void
    {
        $commandList = [];
        foreach ($this->trueCommand as $commandText => $method) {
            $commandList[] = $commandText;
        }

        $this->botApi->sendMessage($command->chatId, 'All command list: ' . implode(', ', $commandList));
    }
}
