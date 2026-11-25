<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class ChannelOptimization
{
    public function __construct(
        private Client $client
    ) {}

    public function table(string $identifier, string $startDate, string $endDate): ?array
    {
        return $this->client->request(
            'GET',
            "/api/channel-optimization/{$identifier}/table",
            ['startDate' => $startDate, 'endDate' => $endDate]
        );
    }

    public function graph(string $identifier, string $startDate, string $endDate): ?array
    {
        return $this->client->request(
            'GET',
            "/api/channel-optimization/{$identifier}/graph",
            ['startDate' => $startDate, 'endDate' => $endDate]
        );
    }
}
