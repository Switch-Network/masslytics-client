<?php

namespace SwitchNetwork\Masslytics\Api;

use SwitchNetwork\Masslytics\Client;

class IndirectImpact
{
    public function __construct(
        private Client $client,
    ) {}

    public function indirectImpact(
        string $identifier,
        ?string $compareDate = null,
        ?int $brandId = null,
        ?int $campaignId = null
    ): ?array {
        return $this->client->request(
            'GET',
            "/api/indirectImpact/{$identifier}/",
            [
                'compare' => $compareDate ?? '',
                'brand' => $brandId,
                'campaign' => $campaignId,
            ],
        );
    }
}
