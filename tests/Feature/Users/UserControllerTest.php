<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_canont_see_users_list_when_unauthorized()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'yousef_mousa'),
        ]);
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/admin/users');
        $response->assertStatus(500);
    }
}
