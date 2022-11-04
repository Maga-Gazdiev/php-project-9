<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlTest extends TestCase
{
    private $id;

    public function testHome(): void
    {
        $response = $this->get(route('/home'));
        $response->assertOk();
    }

    public function testIndex(): void
    {

        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testShow(): void
    {
        $response = $this->get(route('urls.show', $this->id));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = ['url' => ['name' => 'https://www.example.ru']];
        $response = $this->post(route('urls.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', $data['url']);
    }
}
