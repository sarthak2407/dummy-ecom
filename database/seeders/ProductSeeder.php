<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User; // Assuming you have a User model
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Assuming you have some users in the users table
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) { // Create 5 products for each user
                Product::create([
                    'name' => $faker->word,
                    'description' => $faker->sentence,
                    'price' => $faker->randomFloat(2, 1, 100), // Random price between 1 and 100
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
