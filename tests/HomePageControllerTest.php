<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;

class HomePageControllerTest extends TestCase
{
    public function testCreate()
    {
        $this->get(route('home'));
        $this->assertResponseStatus(200);
    }
}
