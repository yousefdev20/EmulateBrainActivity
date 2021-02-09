<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_user_can_view_a_register_form(){
        $response = $this->get('/register');

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }
    public function test_user_can_register()
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'Yousef_',
            'phone' => '0790402111',
            'email' => 'yousefTest.dev20@gmail.com',
            'password' => 'yousef_123',
            'password_confirmation' => 'yousef_123'
        ]);

        $response->assertStatus(500);
    }

}
