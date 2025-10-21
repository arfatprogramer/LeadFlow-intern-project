<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $this->call([
            RoleSedder::class,
            UserSeeder::class,
        ]);

        // Lead::factory(10)->create();

    }
}
