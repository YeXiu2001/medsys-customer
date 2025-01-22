<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Raymart Paraiso', 
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('super1234')
        ]);
        $superAdmin->assignRole('Super Admin');

    }
}
