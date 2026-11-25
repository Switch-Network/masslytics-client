<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class RoiReach
{
    public function __construct(
        private Client $client
    ) {}

    public function reachToConversions(string $identifier, string $startDate, string $endDate, string $attributionMethod): ?array
    {
        return $this->client->request(
            'GET',
            "/api/roi/{$identifier}/reachToConversions",
            ['startDate' => $startDate, 'endDate' => $endDate, 'attributionMethod' => $attributionMethod]
        );
    }

    public function onTraffic(string $identifier, string $startDate, string $endDate, string $attributionMethod): ?array
    {
        return $this->client->request(
            'GET',
            "/api/roi/{$identifier}/onTraffic",
            ['startDate' => $startDate, 'endDate' => $endDate, 'attributionMethod' => $attributionMethod]
        );
    }

    public function returnOnConversions(string $identifier, string $startDate, string $endDate, string $attributionMethod): ?array
    {
        return $this->client->request(
            'GET',
            "/api/roi/{$identifier}/returnOnConversions",
            ['startDate' => $startDate, 'endDate' => $endDate, 'attributionMethod' => $attributionMethod]
        );
    }

    public function mediaPressure(string $identifier, string $startDate, string $endDate, string $attributionMethod): ?array
    {
        return $this->client->request(
            'GET',
            "/api/roi/{$identifier}/mediaPressure",
            ['startDate' => $startDate, 'endDate' => $endDate, 'attributionMethod' => $attributionMethod]
        );
    }
}
