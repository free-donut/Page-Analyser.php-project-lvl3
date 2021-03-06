<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class DomainControllerTest extends TestCase
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
        $this->post(route('domains.store', ['url' => $url]))->assertResponseStatus(302);
        $this->seeInDatabase('Domains', [
                'url_adress' => $url,
                'status_code' => 200,
                'content_length' => $content_length,
                'body' => $content
             ]);
    }

    public function testShow()
    {
        $domain = factory('App\Domain')->create();
        $id = $domain->id;
        $this->get(route('domains.show', ['id' => $id]));
        $this->assertResponseStatus(200);
    }

    public function testIndex()
    {
        $domain = factory('App\Domain', 5)->create();
        $this->get(route('domains.index'));
        $this->assertResponseStatus(200);
    }
}
