<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
//use Illuminate\Http\Response;
//use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class DatabaseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testDatabase()
    {

        $mock = new MockHandler([
             new Response(200, ['X-Foo' => 'Bar'], 'Hello, World'),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $this->app->instance(Client::class, new Client(['handler' => $handlerStack]));

        $this->post('/domains', ['url' => 'https://ru.hexlet.io/'])
             ->seeInDatabase('Domains', [
                 'url_adress' => 'https://ru.hexlet.io/', 
                 'status_code' => 200,
            ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDomains()
    {
        $response = $this->call('GET', '/domains');

        $this->assertEquals(200, $response->status());
    }
}
