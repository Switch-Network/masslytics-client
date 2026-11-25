<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class TopPages
{
    public function __construct(
        private Client $client,
    ) {}

    public function get(
        string $identifier,
        string $startDate,
        string $endDate,
    ): ?array {
        return $this->client->request(
            'GET',
            "/api/topPages/{$identifier}",
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
            ],
        );
    }
}
