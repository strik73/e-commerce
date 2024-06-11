<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'name' => 'VIEW ADMIN',
                'guard_name' => 'web',
                'modul' => 'admin',
            ], [
                'name' => 'VIEW USER',
                'guard_name' => 'web',
                'modul' => 'user',
            ], [
                'name' => 'CREATE USER',
                'guard_name' => 'web',
                'modul' => 'user',
            ], [
                'name' => 'EDIT USER',
                'guard_name' => 'web',
                'modul' => 'user',
            ], [
                'name' => 'VIEW CATEGORY',
                'guard_name' => 'web',
                'modul' => 'category',
            ], [
                'name' => 'CREATE CATEGORY',
                'guard_name' => 'web',
                'modul' => 'category',
            ], [
                'name' => 'EDIT CATEGORY',
                'guard_name' => 'web',
                'modul' => 'category',
            ], [
                'name' => 'VIEW ITEMS',
                'guard_name' => 'web',
                'modul' => 'items',
            ], [
                'name' => 'CREATE ITEMS',
                'guard_name' => 'web',
                'modul' => 'items',
            ], [
                'name' => 'EDIT ITEMS',
                'guard_name' => 'web',
                'modul' => 'items',
            ], [
                'name' => 'VIEW TRANSACTION',
                'guard_name' => 'web',
                'modul' => 'transaction',
            ], [
                'name' => 'CREATE TRANSACTION',
                'guard_name' => 'web',
                'modul' => 'transaction',
            ], [
                'name' => 'EDIT TRANSACTION',
                'guard_name' => 'web',
                'modul' => 'transaction',
            ], [
                'name' => 'VIEW PAYMENT',
                'guard_name' => 'web',
                'modul' => 'payment',
            ], [
                'name' => 'CREATE PAYMENT',
                'guard_name' => 'web',
                'modul' => 'payment',
            ], [
                'name' => 'EDIT PAYMENT',
                'guard_name' => 'web',
                'modul' => 'payment',
            ], [
                'name' => 'VIEW MERCHANT',
                'guard_name' => 'web',
                'modul' => 'merchant',
            ], [
                'name' => 'VIEW BUYER',
                'guard_name' => 'web',
                'modul' => 'buyer',
            ]
        ]);

        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $merchant = Role::create(['name' => 'Merchant']);
        $user = Role::create(['name' => 'User']);

        $superAdmin->givePermissionTo([
            'VIEW ADMIN',
            'VIEW USER',
            'CREATE USER',
            'EDIT USER',
            'VIEW CATEGORY',
            'CREATE CATEGORY',
            'EDIT CATEGORY',
            'VIEW ITEMS',
            'CREATE ITEMS',
            'EDIT ITEMS',
            'VIEW TRANSACTION',
            'CREATE TRANSACTION',
            'EDIT TRANSACTION',
            'VIEW PAYMENT',
            'CREATE PAYMENT',
            'EDIT PAYMENT',
            'VIEW MERCHANT',
            'VIEW BUYER',
        ]);

        $admin->givePermissionTo([
            'VIEW ADMIN',
            'VIEW USER',
            'VIEW CATEGORY',
            'CREATE CATEGORY',
            'EDIT CATEGORY',
            'VIEW ITEMS',
            'VIEW TRANSACTION',
            'VIEW PAYMENT',
            'VIEW MERCHANT',
            'VIEW BUYER',
        ]);

        $merchant->givePermissionTo([
            'VIEW MERCHANT',
            'VIEW BUYER',
        ]);

        $user->givePermissionTo([
            'VIEW BUYER'
        ]);

        $userSA = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'role_id' => 1,
            'username' => 'superadmin',
            'password' => Hash::make('123456'),
            'phone' => '1234567890',
            'gender' => 'Male',
            'city' => 'Bandung',
            'address' => 'Kopo Sayati 165',
            'status' => true,
            'created_at' => \now(),
            'updated_at' => \now(),
        ]);
        $userSA->assignRole($superAdmin);

        $userAdmin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'role_id' => 2,
            'username' => 'admin1',
            'password' => Hash::make('123456'),
            'phone' => '1234567890',
            'gender' => 'Male',
            'city' => 'Bandung',
            'address' => 'Kopo Sayati 165',
            'status' => true,
            'created_at' => \now(),
            'updated_at' => \now(),
        ]);
        $userAdmin->assignRole($admin);

        $userMerchant = User::factory()->create([
            'name' => 'Yefta Store',
            'email' => 'yefstore@mail.com',
            'role_id' => 3,
            'username' => 'yeftastore',
            'password' => Hash::make('123456'),
            'phone' => '082123456789',
            'gender' => 'Male',
            'city' => 'Bandung',
            'address' => 'Kosambi 69',
            'status' => true,
            'created_at' => \now(),
            'updated_at' => \now(),
        ]);
        $userMerchant->assignRole($merchant);

        $userBuyer = User::factory()->create([
            'name' => 'Yefta',
            'email' => 'yeftasm@mail.com',
            'role_id' => 4,
            'username' => 'yeftasm',
            'password' => Hash::make('123456'),
            'phone' => '082987654321',
            'gender' => 'Male',
            'city' => 'Bandung',
            'address' => 'Pasirkoja 4a',
            'status' => true,
            'created_at' => \now(),
            'updated_at' => \now(),
        ]);
        $userBuyer->assignRole($user);
    }
}
