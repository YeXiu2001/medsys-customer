<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $pharmacy_staff = Role::create(['name' => 'Pharmacy Staff']);
        
        $pharmacy_staff->givePermissionTo([
            'pharmacy-full',
            'pharmacy-view',
        ]);
    }
}