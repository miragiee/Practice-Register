<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    public function test_main_page_is_accessible()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Практикум');
    }

    public function test_help_page_is_accessible()
    {
        $response = $this->get('/help');

        $response->assertStatus(200);
        $response->assertSee('Помощь');
    }

    public function test_register_page_is_accessible()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Регистрация');
    }

    public function test_auth_page_is_accessible()
    {
        $response = $this->get('/auth');

        $response->assertStatus(200);
        $response->assertSee('login');
    }

    public function test_students_in_search_page_is_accessible()
    {
        $response = $this->get('/students-in-search');

        $response->assertStatus(200);
        $response->assertSee('Студенты');
    }
}
