<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\microsites;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MicrositesSeeder extends Seeder
{
    public function run(): void
    {
        microsites::factory()
            ->count(5)
            ->for(Category::factory()->create())
            ->create();
    }
}
