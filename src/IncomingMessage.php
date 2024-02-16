<?php

declare(strict_types=1);

namespace MagaBot;

readonly class IncomingMessage
{
    public string $text;
    public string $senderName;

    public int $chatId;

    public function __construct(array $update)
    {
        $this->text = $update['message']['text'];
        $this->senderName = $update['message']['from']['username'];
        $this->chatId = $update['message']['chat']['id'];
    }
}