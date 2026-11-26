<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class Brand
{
    public function __construct(
        private Client $client
    ) {}

    public function index(): ?array
    {
        return $this->client->request(
            'GET',
            '/api/brands'
        );
    }

    public function get(string $identifier): ?array
    {
        return $this->client->request(
            'GET',
            "/api/brands/{$identifier}"
        );
    }

    public function create(array $data): ?array
    {
        return $this->client->request(
            'POST',
            '/api/brands',
            $data
        );
    }

    public function update(string $identifier, array $data): ?array
    {
        return $this->client->request(
            'PUT',
            "/api/brands/{$identifier}",
            $data
        );
    }

    public function delete(string $identifier): ?array
    {
        return $this->client->request(
            'DELETE',
            "/api/brands/{$identifier}"
        );
    }

    public function recalculateResults(string $identifier, string $startDate, string $endDate): ?array
    {
        return $this->client->request(
            'POST',
            "/api/brands/{$identifier}/recalculateResults",
            [
                'start' => $startDate,
                'end' => $endDate,
            ],
        );
    }
}
