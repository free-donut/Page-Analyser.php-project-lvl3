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
    //use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testDatabase()
    {
        $response = $this->call('POST', '/domains', ['url' => 'https://ru.hexlet.io/']);
        // Make call to application...

        $this->seeInDatabase('Domains', ['name' => 'https://ru.hexlet.io/']);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */

    /*public function testDatabase2()
    {

        $this->mock(Client::class, function ($mock) {
            $mock->shouldReceive(['getBody', 'getSize', 'getStatusCode'])->once();
        });


        $response = $this->call('POST', '/domains', ['url' => 'https://ru.hexlet.io/']);
        // Make call to application...

        $this->seeInDatabase('Domains', ['name' => 'https://ru.hexlet.io/']);
    }*/

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
