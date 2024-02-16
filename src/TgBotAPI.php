<?php

declare(strict_types=1);

namespace MagaBot;

use GuzzleHttp\Client;

class TgBotAPI
{
    private const API_URL_PATTERN = 'https://api.telegram.org/bot%s/%s';
    private const LATEST_UPDATE_TRACKER_FILE = __DIR__ .'/latestUpdate.txt';

    private readonly string $token;
    private readonly Client $httpClient;

    private int $offset = 0;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->httpClient = new Client();
        if (file_exists(self::LATEST_UPDATE_TRACKER_FILE)) {
            $this->offset = (int) file_get_contents(__DIR__ . '/latestUpdate.txt');
        }
    }

    /**
     * @return IncomingMessage[]
     */
    public function getUpdates(): array
    {
        $url = sprintf(self::API_URL_PATTERN, $this->token, 'getUpdates');

        $response = $this->httpClient->request('GET', $url, [
            'query' => ['offset' => $this->offset]]
        );
        $data = json_decode($response->getBody()->getContents(), true);

        if (!isset($data['ok'], $data['result'])) {
            throw new \RuntimeException('Server returned unexpected result!');
        }

        $updates = $data['result'];

        $messages = [];
        foreach ($updates as $update) {
            $messages[] = new IncomingMessage($update);
            $this->offset = $update['update_id'] + 1;
        }

        file_put_contents(self::LATEST_UPDATE_TRACKER_FILE, $this->offset);

        return $messages;
    }

    public function sendMessage(int $toChat, string $text): void
    {
        $url = sprintf(self::API_URL_PATTERN, $this->token, 'sendMessage');

        $result = $this->httpClient->request('POST', $url, [
            'json' => [
                'chat_id' => $toChat,
                'text' => $text,
            ],
        ]);
    }
}
