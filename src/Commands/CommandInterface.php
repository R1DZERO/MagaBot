<?php
declare(strict_types=1);

namespace MagaBot\Commands;

use MagaBot\IncomingMessage;
use MagaBot\TgBotAPI;

interface CommandInterface
{
    public function listAliases(): array;

    public function canHandle(IncomingMessage $message): bool;

    public function handle(IncomingMessage $message, TgBotAPI $botAPI): void;
}
