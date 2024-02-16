<?php

declare(strict_types=1);

use MagaBot\TgBotAPI;

require_once __DIR__ .'/vendor/autoload.php';

date_default_timezone_set('Europe/Moscow');

$token = file_get_contents(__DIR__ .'/tgtoken.txt');

$botApi = new TgBotAPI($token);

while (true) {
    foreach ($botApi->getUpdates() as $update) {
        echo sprintf('%s sent: %s', $update->senderName, $update->text);
        if ($update->text === 'ShowTime') {
            $botApi->sendMessage($update->chatId, date('H:i:s d.m.Y'));
        } else {
            $botApi->sendMessage($update->chatId, 'Unknown command. Write !help to see list of available commands.');
        }
    }

    sleep(5);
}
