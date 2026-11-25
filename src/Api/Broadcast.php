<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class Broadcast
{
    public function __construct(
        private Client $client
    ) {}

    public function index(
        ?string $dateRange = null,
        ?string $startDate = null,
        ?string $endDate = null,
        ?bool $withoutExternalId = null,
    ): ?array {
        return $this->client->request(
            'GET',
            '/api/broadcasts',
            [
                'dateRange' => $dateRange,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'withoutExternalId' => $withoutExternalId,
            ]
        );
    }

    public function create(array $data): ?array
    {
        return $this->client->request(
            'POST',
            '/api/broadcasts',
            $data
        );
    }

    public function get(string $broadcast): ?array
    {
        return $this->client->request(
            'GET',
            "/api/broadcasts/{$broadcast}"
        );
    }

    public function update(string $broadcast, array $data): ?array
    {
        return $this->client->request(
            'PUT',
            "/api/broadcasts/{$broadcast}",
            $data
        );
    }

    public function delete(string $broadcast): ?array
    {
        return $this->client->request(
            'DELETE',
            "/api/broadcasts/{$broadcast}"
        );
    }

    public function bulkDestroy(array $broadcastIds): ?array
    {
        return $this->client->request(
            'POST',
            '/api/broadcasts/bulkDestroy',
            ['ids' => $broadcastIds]
        );
    }

    public function bulkStore(array $broadcasts): ?array
    {
        return $this->client->request(
            'POST',
            '/api/broadcasts/bulkStore',
            ['broadcasts' => $broadcasts]
        );
    }
}
