<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'basic', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'invoicing', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'subscribe', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
