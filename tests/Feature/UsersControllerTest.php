<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testItCanListUsers(): void
    {
        $this->withoutExceptionHandling();
        $user = User::find(1);
        $response = $this->actingAs($user)
                         ->get(route('users.index'));

        $response->assertStatus(200);
    }

    public function testUserGuestCanListUsers(): void
    {
        $this->withoutExceptionHandling();
        $user = User::find(3);
        $response = $this->actingAs($user)
                         ->get(route('users.index'));

        $response->assertStatus(302);
    }
}
