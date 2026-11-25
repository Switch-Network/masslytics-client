<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class ConversionUrl
{
    public function __construct(
        private Client $client
    ) {}

    public function index(string $identifier): ?array
    {
        return $this->client->request(
            'GET',
            "/api/brands/{$identifier}/conversionUrls"
        );
    }

    public function create(string $identifier, string $url): ?array
    {
        return $this->client->request(
            'POST',
            "/api/brands/{$identifier}/conversionUrls",
            ['string' => $url]
        );
    }

    public function update(string $identifier, string $conversionUrlId, string $url): ?array
    {
        return $this->client->request(
            'PUT',
            "/api/brands/{$identifier}/conversionUrls/{$conversionUrlId}",
            ['string' => $url]
        );
    }

    public function delete(string $identifier, string $conversionUrlId): ?array
    {
        return $this->client->request(
            'DELETE',
            "/api/brands/{$identifier}/conversionUrls/{$conversionUrlId}"
        );
    }

    public function aiSuggestions(string $identifier): ?array
    {
        return $this->client->request(
            'GET',
            "/api/brands/{$identifier}/conversionUrls/aiSuggestions"
        );
    }
}
