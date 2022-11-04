<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function Test_The_Application_Returns_A_Successful_Response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
