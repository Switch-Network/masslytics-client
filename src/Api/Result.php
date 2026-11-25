<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class Result
{
    public function __construct(
        private Client $client
    ) {}

    public function get(string $identifier, string $startDate, string $endDate, ?string $type = null): ?array
    {
        return $this->client->request(
            'GET',
            "/api/results/{$identifier}",
            ['type' => $type, 'startDate' => $startDate, 'endDate' => $endDate]
        );
    }

    public function daily(string $identifier, string $startDate, string $endDate, ?string $type = null): ?array
    {
        return $this->client->request(
            'GET',
            "/api/results/{$identifier}/daily",
            ['type' => $type, 'startDate' => $startDate, 'endDate' => $endDate]
        );
    }

    public function hourly(string $identifier, string $startDate, string $endDate, ?string $type = null): ?array
    {
        return $this->client->request(
            'GET',
            "/api/results/{$identifier}/hourly",
            ['type' => $type, 'startDate' => $startDate, 'endDate' => $endDate]
        );
    }
}
