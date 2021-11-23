<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Username',
            'email' => 'user@com.com',
            'password' => bcrypt('password'),
            'language' => 'en',
        ]);

        Product::factory(50)->create();
    }
}
