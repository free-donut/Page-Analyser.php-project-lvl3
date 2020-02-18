<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;

class HomePageControllerTest extends TestCase
{
    public function testMain()
    {
        $this->get(route('home.create'));
        $this->assertResponseStatus(200);
    }
}
