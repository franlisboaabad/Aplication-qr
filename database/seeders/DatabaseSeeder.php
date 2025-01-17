<?php

namespace Database\Seeders;

use App\Models\Auto;
use App\Models\Menu;
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
    
        \App\Models\User::factory()->create(
            [
                'name' => 'Frank Lisboa Abad',
                'email' => 'frank@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'), // password
            ]
        );

        // Auto::factory()->create(20);
        Menu::factory()->count(5)->create();
    }
}
