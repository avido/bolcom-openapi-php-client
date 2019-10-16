<?php

use PHPUnit\Framework\TestCase;
use BolCom\Client;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = new Client(getenv('APP_KEY'), 'json', false);
    }

    /** @test */
    public function testAppKey()
    {
        $this->assertNotEquals(
            'YOUR_APP_KEY',
            getenv('APP_KEY'),
            "APP_KEY should be configured to run tests!\n\n" .
            "Run phpunit as follows:\n" .
            "APP_KEY=YOUR_APP_KEY phpunit\n" .
            "or fill in your APP_KEY in phpunit.xml\n"
        );
    }

    /** @test */
    public function testGetPingResponse()
    {
        $response = $this->client->getPingResponse();

        $this->assertObjectHasAttribute('message', $response);
        $this->assertEquals('Hello world!', $response->message);
    }

    /** @test */
    public function testGetProduct()
    {
        $response = $this->client->getProduct('9200000015051259');

        $this->assertObjectHasAttribute('products', $response);
        $this->assertIsArray($response->products);
    }
}
