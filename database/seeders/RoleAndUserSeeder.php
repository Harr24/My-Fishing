<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions dari Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Role sesuai spesifikasi
        Role::create(['name' => 'super']);
        Role::create(['name' => 'sales_manager']);
        Role::create(['name' => 'stock_manager']);
        Role::create(['name' => 'member']);

        // 2. Buat Akun Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin MyFishing',
            'email' => 'myfishing@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // 3. Assign role 'super' ke akun tersebut
        $superAdmin->assignRole('super');
    }
}
