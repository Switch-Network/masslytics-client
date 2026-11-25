<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class Campaign
{
    public function __construct(
        private Client $client
    ) {}

    public function index(): ?array
    {
        return $this->client->request(
            'GET',
            '/api/campaigns'
        );
    }

    public function show(string $uuid): ?array
    {
        return $this->client->request(
            'GET',
            "/api/campaigns/{$uuid}"
        );
    }

    public function create(array $data): ?array
    {
        return $this->client->request(
            'POST',
            '/api/campaigns',
            $data
        );
    }

    public function update(string $uuid, array $data): ?array
    {
        return $this->client->request(
            'PUT',
            "/api/campaigns/{$uuid}",
            $data
        );
    }

    public function delete(string $uuid): ?array
    {
        return $this->client->request(
            'DELETE',
            "/api/campaigns/{$uuid}"
        );
    }

    public function results(
        string $uuid,
        string $used_budget,
        string $currency,
        string $realized_reach,
        ?string $averageOrderValue,
        string $attribution_method,
    ): ?array {
        return $this->client->request(
            'GET',
            "/api/campaigns/{$uuid}/results",
            [
                'used_budget' => $used_budget,
                'currency' => $currency,
                'realized_reach' => $realized_reach,
                'averageOrderValue' => $averageOrderValue,
                'attribution_method' => $attribution_method,
            ]
        );
    }
}
