<?php

namespace Tests\Feature\Microsites;

use App\Models\Category;
use App\Models\Microsites;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MicrositesShowSpecificTest extends TestCase
{
    public function testItCanSeeSiteShowWhenUserIsNotAuth(): void
    {
        $user = User::factory()->create();
        $microsite = Microsites::factory()
            ->for(Category::factory()->create())
            ->for(($user))
            ->create(
                [
                    'name' => 'test-name',

                ]
            );
        $response = $this->get(route('microsites.show', $microsite->id));
        $response->assertStatus(302);
    }
}
