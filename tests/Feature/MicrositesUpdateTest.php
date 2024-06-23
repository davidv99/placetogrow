<?php

namespace Tests\Feature;

use App\Constants\DocumentTypes;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;
use App\Models\microsites;

class MicrositesUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanNotSeeSiteUpdateWhenUserIsNotAuth(): void
    {
        $category = Category::factory()->create();
        $microsite = microsites::factory()
            ->for($category)
            ->create();
        
        // $response = $this->get(route('microsites.edit', $microsite, $category,));
        // $response->assertRedirect(route('microsites.edit'));
        $response = $this->put(route('microsites.update', $microsite, $category));
        $response->assertRedirect(route('login'));
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
    //     $microsite = microsites::factory()
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
