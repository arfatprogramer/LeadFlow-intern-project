<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Super_Admin','Admin', 'Manager', 'Sales', 'Support', 'Test'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['role_name' => $role]);
        }
    }
}
