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
        // User::factory(10)->create();

        User::factory(10)->create();
        Role::factory()->create([
            'role_name' => 'admin',
            'user_id' => 1,
        ]);
         Role::factory()->create([
            'role_name' => 'manager',
            'user_id' => 2,
        ]);
         Role::factory()->create([
            'role_name' => 'sales',
            'user_id' => 3,
        ]);
        Lead::factory(50)->create();

    }
}
