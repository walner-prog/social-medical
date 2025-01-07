<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'registered' => true, // Puedes ajustar esto o usar un valor predeterminado
            ]);
        }
    }
}
