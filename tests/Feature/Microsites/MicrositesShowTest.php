<?php

namespace Tests\Feature\Microsites;

use App\Constants\PermissionSlug;
use App\Models\Category;
use App\Models\Microsites;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class MicrositesShowTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanNotSeeSiteShowWhenUserIsNotAuth(): void
    {
        $response = $this->get(route('microsites.show', 1));
        $response->assertRedirect(route('login'));
    }

    public function testItCanSeeShowSite(): void
    {
        Microsites::factory()
            ->for(Category::factory()->create())
            ->create(
                [
                    'name' => 'test-name',

                ]
            );
        $user = User::factory()->create();
        $permission = Permission::firstOrCreate(['name' => PermissionSlug::MICROSITES_VIEW]);
        $user->givePermissionTo($permission);

        $microsite = Microsites::first();
        $response = $this->actingAs($user)
            ->get(route('microsites.show', $microsite->id));
        $response->assertOk();
        $response->assertSee('test-name');
    }
}
