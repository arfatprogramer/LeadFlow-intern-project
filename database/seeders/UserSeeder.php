<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'super@leadflow.com',
                'password' => Hash::make('leadflow'),
                'role' => 'Super-Admin',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@leadflow.com',
                'password' => Hash::make('leadflow'),
                'role' => 'Admin',
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@leadflow.com',
                'password' => Hash::make('leadflow'),
                'role' => 'Manager',
            ],
            [
                'name' => 'Sales User',
                'email' => 'sales@leadflow.com',
                'password' => Hash::make('leadflow'),
                'role' => 'Sales',
            ],
            [
                'name' => 'Support User',
                'email' => 'support@leadflow.com',
                'password' => Hash::make('leadflow'),
                'role' => 'Support',
            ],
            [
                'name' => 'Test User',
                'email' => 'test@leadflow.com',
                'password' => Hash::make('leadflow'),
                'role' => 'Test',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                ]
            );

            // Attach the role
            $role = Role::where('role_name', $userData['role'])->first();
            if ($role) {
                $user->roles()->syncWithoutDetaching([$role->id]);
            }
        }
    }
}
