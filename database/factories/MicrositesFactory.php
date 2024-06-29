<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Node\Block\Document;
use App\Constants\DocumentTypes;
use App\Constants\Currency;
use App\Constants\MicrositesTypes;
use App\Models\Category;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Microsites>
 */
class MicrositesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->text(20),
            'name' => $this->faker->company(),
            'document_type' => $this->faker->randomElement(array_column(DocumentTypes::cases(), 'name')),
            'document_number' => $this->faker->numerify('###########'),
            'logo' => $this->faker->imageUrl(),
            'category_id' => Category::all()->random()->id,
            'currency' => $this->faker->randomElement(array_column(Currency::cases(), 'name')),
            'payment_expiration' => $this->faker->numberBetween(1, 30),
            'user_id' => User::factory()->create()->id,
            'site_type' => $this->faker->randomElement(array_column(MicrositesTypes::cases(), 'name')),
        ];
    }
}
