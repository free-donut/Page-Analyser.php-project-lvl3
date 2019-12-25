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
            new Response(202, ['X-Foo' => 'Bar'], 'Hello, World'),
        ]);
        $handlerStack = HandlerStack::create($mock);

        $this->app->instance(Client::class, new Client(['handler' => $handlerStack]));

        $this->post('/domains', ['url' => 'https://ru.hexlet.io/'])
             ->seeInDatabase('Domains', [
                 'url_adress' => 'https://ru.hexlet.io/', 
                 'status_code' => 202,
            ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDomains()
    {
        //$url = factory('App\Url')->make();
        //$response = $this->call('POST', '/domains', ['url' => 'http://yula1.freedonut123test.space/']);
        $response = $this->call('GET', '/domains');

        $this->assertEquals(200, $response->status());
    }
}
