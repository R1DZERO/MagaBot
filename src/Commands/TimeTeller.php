<?php
declare(strict_types=1);

namespace MagaBot\Commands;

use MagaBot\IncomingMessage;
use MagaBot\TgBotAPI;

class TimeTeller implements CommandInterface
{
    private const COMMAND_SHOW_TIME = '!show time';
    private const COMMAND_SHOW_DATE = '!show date';

    public function listAliases(): array
    {
        return [
            self::COMMAND_SHOW_TIME,
            self::COMMAND_SHOW_DATE
        ];
    }

    public function canHandle(IncomingMessage $message): bool
    {
        return in_array($message->text, $this->listAliases());
    }

    public function handle(IncomingMessage $message, TgBotAPI $botAPI): void
    {
        if ($message->text === self::COMMAND_SHOW_DATE) {
            $botAPI->sendMessage($message->chatId, date('d.m.Y'));

            return;
        }

        if ($message->text === self::COMMAND_SHOW_TIME) {
            $botAPI->sendMessage($message->chatId, date('H:i'));
        }
    }
}
