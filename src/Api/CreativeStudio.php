<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class CreativeStudio
{
    public function __construct(
        private Client $client,
    ) {}

    public function abTest(
        string $identifier,
        string $startDate,
        string $endDate,
        string $commercialA,
        string $commercialB,
        string $attributionMethod,
    ): ?array {
        return $this->client->request(
            'POST',
            "/api/creative-studio/{$identifier}/ab-test",
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'commercialA' => $commercialA,
                'commercialB' => $commercialB,
                'attributionMethod' => $attributionMethod,
            ],
        );
    }
}
