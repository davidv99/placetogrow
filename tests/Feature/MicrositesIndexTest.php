<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use App\Models\microsites;

class MicrositesIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanNotListSitesWhenUserIsNotAuth(): void
    {
        #show error if test fail


        $response = $this->get(route('microsites.index'));
        $response->assertRedirect(route('login'));
    }

    public function testItCanListSites(): void
    {
        $this->withoutExceptionHandling();

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

    #test if user is not auth
    
}
