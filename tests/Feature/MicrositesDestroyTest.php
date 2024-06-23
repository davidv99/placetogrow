<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;
use App\Models\microsites;

class MicrositesDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanNotSeeSiteDeleteWhenUserIsNotAuth(): void
    {

        $microsite = microsites::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->get(route('microsites.show', $microsite));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function testItCanDestroySite(): void
    {
        $this->withoutExceptionHandling();
        $microsite = microsites::factory()
            ->for(Category::factory()->create())
            ->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('microsites.destroy', $microsite));

        $response->assertRedirect(route('microsites.index'));
    }
}
