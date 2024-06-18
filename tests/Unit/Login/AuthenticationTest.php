<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class AuthenticationTest extends KernelTestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client();
        parent::setUp();
    }

    public function testLoginSuccess(): void
    {
        // Valid credentials
        $response = $this->client->post('http://nginx/api/login_check', [
            'json' => ['email' => 'user@froots.com', 'password' => 'user'],
        ]);

        self::assertEquals(200, $response->getStatusCode());
        self::assertJson($response->getBody()->getContents());
        $responseData = json_decode($response->getBody()->__toString(), true);
        self::assertNotEmpty($responseData['token']);
    }

    public function testInvalidLogin(): void
    {
        // Invalid credentials
        $response = $this->client->post('http://nginx/api/login_check', [
            'http_errors' => false,
            'json' => ['email' => 'user@froots.com', 'password' => 'invalid'],
        ]);
        self::assertEquals(401, $response->getStatusCode());
        self::assertJson($response->getBody()->getContents());
        $responseData = json_decode($response->getBody()->__toString(), true);
        self::assertEquals(['code' => 401, 'message' => 'Invalid credentials.'], $responseData);
    }
}
