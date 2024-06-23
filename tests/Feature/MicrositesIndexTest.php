<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;
use App\Models\microsites;

class MicrositesIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanNotListSitesWhenUserIsNotAuth(): void
    {
        $response = $this->get(route('microsites.index'));
        $response->assertRedirect(route('login'));
    }

    public function testItCanListSites(): void
    {
        microsites::factory()
            ->for(Category::factory()->create())
            ->create(
                [
                    'name' => 'test-name',

                ]
            );
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('microsites.index'));
        $response->assertOk();
        $response->assertSee('test-name');
    }

}
