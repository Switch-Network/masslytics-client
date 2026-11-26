<?php

namespace SwitchNetwork\Masslytics\Facades;

use Illuminate\Support\Facades\Facade;
use SwitchNetwork\Masslytics\Client;

/**
 * @method static \SwitchNetwork\Masslytics\Client timeout(int $seconds)
 * @method static string|null installCheck(string $identifier)
 * @method static array|null user()
 * @method static array|null healthcheck()
 * @method static array|null request(string $method, string $path, array $data = [])
 * @method static \SwitchNetwork\Masslytics\Api\Brand brands()
 * @method static \SwitchNetwork\Masslytics\Api\Broadcast broadcasts()
 * @method static \SwitchNetwork\Masslytics\Api\Campaign campaigns()
 * @method static \SwitchNetwork\Masslytics\Api\ChannelOptimization channelOptimization()
 * @method static \SwitchNetwork\Masslytics\Api\ConversionUrl conversionUrls()
 * @method static \SwitchNetwork\Masslytics\Api\CreativeStudio creativeStudio()
 * @method static \SwitchNetwork\Masslytics\Api\IndirectImpact indirectImpact()
 * @method static \SwitchNetwork\Masslytics\Api\Result results()
 * @method static \SwitchNetwork\Masslytics\Api\RoiReach roiReach()
 * @method static \SwitchNetwork\Masslytics\Api\TopPages topPages()
 *
 * @see Client
 */
class Masslytics extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Client::class;
    }
}
