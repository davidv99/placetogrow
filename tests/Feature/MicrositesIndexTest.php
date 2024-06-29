<?php

namespace Tests\Feature;

use App\Constants\PermissionSlug;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;
use App\Models\Microsites;
use Spatie\Permission\Models\Permission;

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
        $this->withoutExceptionHandling();
        Microsites::factory()
            ->for(Category::factory()->create())
            ->create(
                [
                    'name' => 'test-name',

                ]
            );
        $user = User::factory()->create();
        $permission = Permission::firstOrCreate(['name' => PermissionSlug::MICROSITES_VIEW_ANY]);
        $user->givePermissionTo($permission);
        $response = $this->actingAs($user)
            ->get(route('microsites.index'));
        $response->assertOk();
        $response->assertSee('test-name');
    }

}
