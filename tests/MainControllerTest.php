<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;

class MainControllerTest extends TestCase
{
    public function testMain()
    {
        $this->get(route('main'));
        $this->assertResponseStatus(200);
    }
}
