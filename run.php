<?php

declare(strict_types=1);

use MagaBot\TgBotAPI;

use MagaBot\Commands;

require_once __DIR__ .'/vendor/autoload.php';

date_default_timezone_set('Europe/Moscow');

$token = file_get_contents(__DIR__ .'/tgtoken.txt');

$botApi = new TgBotAPI($token);

$commands = new Commands();

while (true) {
    foreach ($botApi->getUpdates() as $update) {
        echo sprintf('%s sent: %s'.PHP_EOL, $update->senderName, $update->text);
        $botApi->sendMessage($update->chatId, $commands->execute($update->text));
    }

    sleep(5);
}
