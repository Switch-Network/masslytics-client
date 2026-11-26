<?php

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use SwitchNetwork\Masslytics\Client;

it('sends the token to the configured url', function () {
    Http::fake();

    app(Client::class)->user();

    Http::assertSent(function (Request $request) {
        return $request->url() == 'https://masslytics.test/api/user'
            && $request->hasHeader('Authorization', 'Bearer test-token');
    });
});

it('returns the decoded json response', function () {
    Http::fake(['*' => Http::response(['id' => 1, 'name' => 'Example'])]);

    expect(app(Client::class)->brands()->get('ML-123456'))->toBe(['id' => 1, 'name' => 'Example']);
});

it('throws an exception when the response is an error', function () {
    Http::fake(['*' => Http::response(['message' => 'Not Found'], 404)]);

    app(Client::class)->brands()->get('ML-123456');
})->throws(RequestException::class);

it('throws an exception when the connection fails', function () {
    Http::fake(function () {
        throw new ConnectionException('Connection refused');
    });

    app(Client::class)->brands()->index();
})->throws(ConnectionException::class);

it('returns the install check status', function () {
    Http::fake(['*' => Http::response(['status' => 'success_no_calculation', 'last_visitor_at' => null])]);

    expect(app(Client::class)->installCheck('ML-123456'))->toBe('success_no_calculation');
});

it('returns a copy with a timeout and leaves the original unchanged', function () {
    $client = app(Client::class);

    $clientWithTimeout = $client->timeout(5);

    $timeoutProperty = new ReflectionProperty(Client::class, 'timeout');

    expect($timeoutProperty->getValue($clientWithTimeout))->toBe(5)
        ->and($timeoutProperty->getValue($client))->toBeNull();
});

it('sends the parameters', function (Closure $call, string $method, string $path, array $data) {
    Http::fake();

    $call(app(Client::class));

    Http::assertSent(function (Request $request) use ($method, $path, $data) {
        $url = parse_url($request->url());

        parse_str($url['query'] ?? '', $query);

        return $request->method() == $method
            && $url['path'] == $path
            && ($method == 'GET' ? $query : $request->data()) == $data;
    });
})->with([
    'without null values in the query' => [
        function (Client $client) {
            $client->roiReach()->mediaPressure('ML-123456', '2026-10-01', '2026-10-31');
        },
        'GET', '/api/roi/ML-123456/mediaPressure', ['startDate' => '2026-10-01', 'endDate' => '2026-10-31'],
    ],
    'with booleans in the query' => [
        function (Client $client) {
            $client->broadcasts()->index(withoutExternalId: true);
        },
        'GET', '/api/broadcasts', ['withoutExternalId' => '1'],
    ],
    'as a json body' => [
        function (Client $client) {
            $client->brands()->recalculateResults('ML-123456', '2026-10-01', '2026-10-31');
        },
        'POST', '/api/brands/ML-123456/recalculateResults', ['start' => '2026-10-01', 'end' => '2026-10-31'],
    ],
    'without a body when deleting' => [
        function (Client $client) {
            $client->brands()->delete('ML-123456');
        },
        'DELETE', '/api/brands/ML-123456', [],
    ],
]);
