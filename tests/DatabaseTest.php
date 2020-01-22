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
    use DatabaseMigrations;
    
    public function testStore()
    {
        $content = file_get_contents(__DIR__ . "/fixtures/test.html");
        $content_length = strlen($content);
        $url = 'https://ru.hexlet.io/';
        $mock = new MockHandler([
            new Response(200, ['Content-Length' => $content_length], $content)
        ]);
        $handlerStack = HandlerStack::create($mock);
        $this->app->instance(Client::class, new Client(['handler' => $handlerStack]));
        $this->post('/domains', ['url' => $url])
             ->seeInDatabase('Domains', [
                'url_adress' => $url,
                'status_code' => 200,
                'content_length' => $content_length,
                'body' => $content
             ]);
    }

    public function testShow()
    {
        $user = factory('App\Domain')->create();
        $id = $user->id;
        $response = $this->call('GET', '/domains/' . $id);
        $this->assertEquals(200, $response->status());
    }

    public function testIndex()
    {
        $response = $this->call('GET', '/domains');
        $this->assertEquals(200, $response->status());
    }

    public function testMain()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }
}
