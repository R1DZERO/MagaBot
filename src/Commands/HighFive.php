<?php
declare(strict_types=1);

namespace MagaBot\Commands;

use MagaBot\IncomingMessage;
use MagaBot\TgBotAPI;

class HighFive implements CommandInterface
{
    private const COMMAND = '!high five';

    public function listUsages(): array
    {
        return [self::COMMAND];
    }

    public function canHandle(IncomingMessage $message): bool
    {
        return $message->text === self::COMMAND;
    }

    public function handle(IncomingMessage $message, TgBotAPI $botAPI): void
    {
        $botAPI->sendMessage($message->chatId, '✋');
    }
}

