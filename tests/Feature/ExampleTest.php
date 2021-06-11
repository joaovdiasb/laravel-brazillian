<?php

namespace Joaovdiasb\LaravelBrazillian\Tests\Feature;

use Joaovdiasb\LaravelBrazillian\Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
