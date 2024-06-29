<?php

namespace Tests\Feature;

use App\Constants\DocumentTypes;
use App\Constants\PermissionSlug;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;
use App\Models\Microsites;
use Spatie\Permission\Models\Permission;

class MicrositesUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanNotSeeSiteUpdateWhenUserIsNotAuth(): void
    {
        $category = Category::factory()->create();
        $microsite = Microsites::factory()
            ->for($category)
            ->create();
        $response = $this->put(route('microsites.update', $microsite, $category));
        $response->assertRedirect(route('login'));
    }


    public function testItCanUpdateSite(): void
    {
        $this->withoutExceptionHandling();
        //The slug field is required.
        $category = Category::factory()->create();
        $microsite = Microsites::factory()
            ->for($category)
            ->create(
                [
                    'name' => 'test-name',
                    'slug' => 'test-slug',
                    'document_number' => '123456789',
                    'category_id' => $category->id,
                ]
            );
        $user = User::factory()->create();
        $permission = Permission::firstOrCreate(['name' => PermissionSlug::MICROSITES_UPDATE]);
        $user->givePermissionTo($permission);

        $response = $this->actingAs($user)
            ->put(route('microsites.update', $microsite->id), [
                'name' => 'test-name-updated',
                'slug' => 'test-slug-updated',
                'document_number' => '123456789',
                'category_id' => $category->id,
            ]);

        $response->assertRedirect(route('microsites.index'));
        
    }

    // public function testItCanSeeCreateFormSites(): void
    // {
    //     $response = $this->actingAs($User = User::factory()->create())
    //         ->get(route('microsites.create'));
    //     $response->assertOk();
    //     $response->assertViewIs('microsites.create');
    // }

    // public function testItCanStoreSite(): void
    // {
    //     $this->withoutExceptionHandling();
    //     $microsite = Microsites::factory()
    //         ->for(Category::factory()->create())
    //         ->make();
    //     $user = User::factory()->create();
    //     #imprimir microservice
    //     $response = $this->actingAs($user)
    //         ->post(route('microsites.store'), $microsite->toArray());

    //     $response->assertRedirect(route('microsites.index'));

    //     $this->assertDatabaseHas('microsites', [
    //         'name' => $microsite->name,
            
    //     ]);
    // }
}
