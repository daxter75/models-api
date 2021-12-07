<?php

namespace Database\Seeders;

use App\Models\Brand;
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

        User::factory(10)->create();
        Brand::factory(10)->create();
        Product::factory(50)->create();
    }
}
