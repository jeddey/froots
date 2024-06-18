<?php

declare(strict_types=1);

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use GuzzleHttp\Client;

/**
 * @internal
 *
 * @coversNothing
 */
final class ProductsTest extends ApiTestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client();
        parent::setUp();
    }

    public function testOrderProductsWithValidToken(): void
    {
        $response = $this->client->post('http://nginx/api/login_check', [
            'json' => ['email' => 'user@froots.com', 'password' => 'user'],
        ]);

        self::assertEquals(200, $response->getStatusCode());
        self::assertJson($response->getBody()->getContents());
        $responseData = json_decode($response->getBody()->__toString(), true);
        $token = $responseData['token'];

        $apiResponse = $this->client->get('http://nginx/api/orders/1/products', [
            'json' => ['email' => 'user@froots.com', 'password' => 'user'],
            'headers' => [
                'Authorization' => sprintf('%s %s', 'Bearer', $token),
                'Content-Type' => 'application/json',
            ],
        ]);

        self::assertEquals(200, $apiResponse->getStatusCode());
        self::assertJson($apiResponse->getBody()->getContents());
        $responseData = json_decode($apiResponse->getBody()->__toString(), true);
        self::assertNotEmpty($responseData);
    }

    public function testOrderProductsWithInvalidToken(): void
    {
        $token = 'invalid';
        $apiResponse = $this->client->get('http://nginx/api/orders/1/products', [
            'http_errors' => false,
            'json' => ['email' => 'user@froots.com', 'password' => 'user'],
            'headers' => [
                'Authorization' => sprintf('%s %s', 'Bearer', $token),
                'Content-Type' => 'application/json',
            ],
        ]);

        self::assertEquals(401, $apiResponse->getStatusCode());
        self::assertJson($apiResponse->getBody()->getContents());
        $responseData = json_decode($apiResponse->getBody()->__toString(), true);
        self::assertEquals(['code' => 401, 'message' => 'Invalid JWT Token'], $responseData);
    }
}
