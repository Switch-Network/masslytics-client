<?php

namespace SwitchNetwork\Masslytics;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use SwitchNetwork\Masslytics\Api\Brand;
use SwitchNetwork\Masslytics\Api\Broadcast;
use SwitchNetwork\Masslytics\Api\Campaign;
use SwitchNetwork\Masslytics\Api\ChannelOptimization;
use SwitchNetwork\Masslytics\Api\ConversionUrl;
use SwitchNetwork\Masslytics\Api\CreativeStudio;
use SwitchNetwork\Masslytics\Api\IndirectImpact;
use SwitchNetwork\Masslytics\Api\Result;
use SwitchNetwork\Masslytics\Api\RoiReach;
use SwitchNetwork\Masslytics\Api\TopPages;

class Client
{
    protected string $token;

    protected string $url;

    protected ?int $timeout = null;

    public function __construct()
    {
        $this->token = config('masslytics.token');
        $this->url = rtrim(config('masslytics.url'), '/');
    }

    public function timeout(int $seconds): static
    {
        $client = clone $this;
        $client->timeout = $seconds;

        return $client;
    }

    public function installCheck(string $identifier): ?string
    {
        $json = $this->request('GET', '/api/installCheck/'.$identifier, [
            'format' => 'json',
        ]);

        if ($json && array_key_exists('status', $json)) {
            return $json['status'];
        }

        return null;
    }

    public function user(): ?array
    {
        return $this->request('GET', '/api/user');
    }

    public function healthcheck(): ?array
    {
        return $this->request('GET', '/api/masslytics/healthcheck');
    }

    public function request(string $method, string $path, array $data = []): ?array
    {
        try {
            $request = Http::withToken($this->token);

            if ($this->timeout) {
                $request->connectTimeout($this->timeout)->timeout($this->timeout);
            }

            $response = $request->{$method}($this->url.$path, $data);

            $response->throw();

            return $response->json();
        } catch (ConnectionException $e) {
            Log::error('Masslytics request failed (connection)', [
                'method' => $method,
                'path' => $path,
                'error' => $e->getMessage(),
            ]);

            return null;
        } catch (RequestException $e) {
            Log::error('Masslytics request failed (request)', [
                'method' => $method,
                'path' => $path,
                'status' => $e->response->status(),
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function conversionUrls(): ConversionUrl
    {
        return new ConversionUrl($this);
    }

    public function brands(): Brand
    {
        return new Brand($this);
    }

    public function broadcasts(): Broadcast
    {
        return new Broadcast($this);
    }

    public function campaigns(): Campaign
    {
        return new Campaign($this);
    }

    public function results(): Result
    {
        return new Result($this);
    }

    public function channelOptimization(): ChannelOptimization
    {
        return new ChannelOptimization($this);
    }

    public function roiReach(): RoiReach
    {
        return new RoiReach($this);
    }

    public function indirectImpact(): IndirectImpact
    {
        return new IndirectImpact($this);
    }

    public function topPages(): TopPages
    {
        return new TopPages($this);
    }

    public function creativeStudio(): CreativeStudio
    {
        return new CreativeStudio($this);
    }
}
