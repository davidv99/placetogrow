<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Node\Block\Document;
use App\Constants\DocumentTypes;
use App\Constants\Currency;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\microsites>
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
            'site_type' => $this->faker->randomElement(['Invoice', 'Donation', 'Suscription']),
            
        ];
    }
}
