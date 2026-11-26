# PHP/Laravel client for the Masslytics API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/switch-network/masslytics-client.svg?style=flat-square)](https://packagist.org/packages/switch-network/masslytics-client)
[![GitHub Tests Action Status](https://github.com/Switch-Network/masslytics-client/actions/workflows/run-tests.yml/badge.svg)](https://github.com/Switch-Network/masslytics-client/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://github.com/Switch-Network/masslytics-client/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/Switch-Network/masslytics-client/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/switch-network/masslytics-client.svg?style=flat-square)](https://packagist.org/packages/switch-network/masslytics-client)

A PHP/Laravel client for the Masslytics API. Manage your brands, conversion URLs, broadcasts and campaigns, and fetch the results of your mass media campaigns.

All routes and parameters are described in the [Masslytics API reference](https://docs.masslytics.io/1.0/api-reference).

## Installation

You can install the package via composer:

```bash
composer require switch-network/masslytics-client
```

Add your API token to your `.env` file. If you do not have a token yet, see [API Access](https://docs.masslytics.io/1.0/api-access).

```dotenv
MASSLYTICS_TOKEN=your-api-token
```

You probably don't need to do this unless you want to change the env variable names, but you can publish the config file with:

```bash
php artisan vendor:publish --tag="masslytics-config"
```

This is the contents of the published config file:

```php
<?php

return [
    // The API token that is sent as a bearer token with every request.
    'token' => env('MASSLYTICS_TOKEN', ''),
    // The base URL of the Masslytics application the requests are sent to.
    'url' => env('MASSLYTICS_URL', 'https://app.masslytics.io'),
];
```

## Usage

Import the Masslytics Facade.

```php
use SwitchNetwork\Masslytics\Facades\Masslytics;

$brands = Masslytics::brands()->index();

$results = Masslytics::results()->daily('ML-123456', '2026-10-01', '2026-10-31');
```

Most methods take the brand **identifier**, for example `ML-123456`.

## Examples

### Brands

```php
Masslytics::brands()->index();
Masslytics::brands()->get('ML-123456');
Masslytics::brands()->create(['name' => 'Example', 'base_url' => 'https://example.com']);
Masslytics::brands()->update('ML-123456', ['name' => 'Example']);
Masslytics::brands()->delete('ML-123456');
Masslytics::brands()->recalculateResults('ML-123456', '2026-10-01', '2026-10-31');
```

### Installation check

```php
$status = Masslytics::installCheck('ML-123456');

if ($status && str_starts_with($status, 'success')) {
    // The tag is installed.
}
```

### Conversion URLs

```php
Masslytics::conversionUrls()->index('ML-123456');
Masslytics::conversionUrls()->create('ML-123456', 'https://example.com/thank-you');
Masslytics::conversionUrls()->update('ML-123456', $conversionUrlId, 'https://example.com/order-complete');
Masslytics::conversionUrls()->delete('ML-123456', $conversionUrlId);
Masslytics::conversionUrls()->aiSuggestions('ML-123456');
```

### Broadcasts

```php
Masslytics::broadcasts()->index(dateRange: 'custom', startDate: '2026-10-01', endDate: '2026-10-31');
Masslytics::broadcasts()->get($broadcastId);
Masslytics::broadcasts()->create([
    'brand_identifier' => 'ML-123456',
    'time' => '2026-10-13 14:30:00',
    'timezone' => 'Europe/Amsterdam',
    'name' => 'Spring commercial',
    'channel' => 'Radio One',
    'external_id' => 'A-1001',
]);
Masslytics::broadcasts()->update($broadcastId, [...]);
Masslytics::broadcasts()->delete($broadcastId);
Masslytics::broadcasts()->bulkCreate([...]);
Masslytics::broadcasts()->bulkDelete([$broadcastId, ...]);
```

`bulkCreate()` updates broadcasts with an `external_id` that already exists instead of creating them again.

### Campaigns

```php
Masslytics::campaigns()->index();
Masslytics::campaigns()->get($uuid);
Masslytics::campaigns()->create([
    'uuid' => $uuid,
    'brand_identifier' => 'ML-123456',
    'name' => 'Autumn campaign',
    'start' => '2026-10-01 00:00:00',
    'end' => '2026-10-31 23:59:59',
]);
Masslytics::campaigns()->update($uuid, [...]);
Masslytics::campaigns()->delete($uuid);
Masslytics::campaigns()->results(
    $uuid,
    usedBudget: '5000',
    currency: 'EUR',
    realizedReach: '400000',
    averageOrderValue: '50',
    attributionMethod: 'instant',
);
```

### Results

```php
Masslytics::results()->get('ML-123456', '2026-10-01', '2026-10-31', type: 'instant');
Masslytics::results()->daily('ML-123456', '2026-10-01', '2026-10-31');
Masslytics::results()->hourly('ML-123456', '2026-10-01', '2026-10-31');
Masslytics::topPages()->get('ML-123456', '2026-10-01', '2026-10-31');
Masslytics::channelOptimization()->table('ML-123456', '2026-10-01', '2026-10-31');
Masslytics::channelOptimization()->graph('ML-123456', '2026-10-01', '2026-10-31');
Masslytics::creativeStudio()->abTest(
    'ML-123456',
    '2026-10-01',
    '2026-10-31',
    'Spring commercial',
    'Summer commercial',
    'extended',
);
Masslytics::indirectImpact()->get('ML-123456', compareDate: '2026-09-01');
```

### Reach & ROI

```php
Masslytics::roiReach()->returnOnTraffic('ML-123456', '2026-10-01', '2026-10-31', 'instant');
Masslytics::roiReach()->returnOnConversions('ML-123456', '2026-10-01', '2026-10-31', 'instant');
Masslytics::roiReach()->reachToConversions('ML-123456', '2026-10-01', '2026-10-31', 'instant');
Masslytics::roiReach()->mediaPressure('ML-123456', '2026-10-01', '2026-10-31', 'instant');
```

When you leave out the attribution method, the method last used by the user of the token is applied.

### Other requests

```php
Masslytics::user();
Masslytics::healthcheck();
Masslytics::request('GET', '/api/installCheck/ML-123456');
```

### Timeouts

Use the `timeout()` function to increase the timeout in seconds.

```php
$broadcasts = Masslytics::timeout(120)->broadcasts()->index();
```

### Error/exception handling

Methods return the JSON response as a PHP array, or `null` when the response is empty, for example after deleting.

```php
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Client\RequestException;

try {
    Masslytics::brands()->create(['name' => '']);
} catch (RequestException $exception) {
    // Handle HTTP errors codes.
} catch (HttpClientException $exception) {
    // Handle connection failures or timeouts.
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](SECURITY.md) on how to report security vulnerabilities.

## License

The Expat License (MIT). Please see [License File](LICENSE.md) for more information.
