<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/admin/home');
    }
    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'yousef_mousa'),
        ]);
        $password = "yousef_mousa";
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/admin/home');
        $this->assertAuthenticatedAs($user);
    }
    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('yousef_mousa'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'incorrect_password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
    public function test_remember_me_functionality()
    {
        $user = User::factory()->create([
            'id' => random_int(1, 100),
            'password' => bcrypt($password = 'yousef_mousa'),
        ]);
        $password = "yousef_mousa";
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);

        $response->assertRedirect('/admin/home');
        // cookie assertion goes here
        $this->assertAuthenticatedAs($user);
    }
}
