<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        
        $user->name = "Brayan Luján Muñoz";
        $user->email = "brayan.lujan@evertecinc.com";
        $user->password = "12345678";

        $user->save();

        $user = new User();
        
        $user->name = "Estefanía Gómez Herrera";
        $user->email = "estefania.gomez@evertecinc.com";
        $user->password = "12345678";

        $user->save();
    }
}
