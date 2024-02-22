<?php
declare(strict_types=1);

namespace MagaBot\Commands;

use MagaBot\IncomingMessage;
use MagaBot\TgBotAPI;

class MemeSender implements CommandInterface
{
    private const COMMAND_BASIC = '!show content';

    public function listAliases(): array
    {
        return [self::COMMAND_BASIC];
    }

    public function canHandle(IncomingMessage $message): bool
    {
        return $message->text === self::COMMAND_BASIC;
    }

    public function handle(IncomingMessage $message, TgBotAPI $botAPI): void
    {
        $picture = __DIR__ . '/../images/pepe.webp';
        $botAPI->sendPhoto($message->chatId, $picture);
    }
}
