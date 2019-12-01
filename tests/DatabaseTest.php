<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

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
        $response = $this->call('POST', '/domains', ['url' => 'http://yula1.freedonut123test.space/']);
        // Make call to application...

        $this->seeInDatabase('Domains', ['name' => 'http://yula1.freedonut123test.space/']);
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
