<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']); 
        $deputyManager = Role::create(['name' => 'deputy-manager']);
        $operationUser = Role::create(['name' => 'operation-user']); 
        $normal_user = Role::create(['name' => 'user']);


        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01722222222',
            'designation' => 'admin',
            'status' => 'active',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($admin);
        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'designation' => "just user",
            'phone' => '01755555555',
            'status' => 'active',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($normal_user);
        $user = User::factory()->create([
            'name' => 'operation user 1',
            'email' => 'operationuser@gmail.com',
            'phone' => '01765655555',
            'status' => 'active',
            'designation' => "OperationUser-1",
            'password' => Hash::make('password')
        ]);
        $user->assignRole($operationUser);

        $user = User::factory()->create([
            'name' => 'manager 1',
            'email' => 'manager@gmail.com',
            'phone' => '01777777777',
            'designation' => "Manager",
            'status' => 'active',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($manager);

        $user = User::factory()->create([
            'name' => 'deputy manager 1',
            'email' => 'deputymanager@gmail.com',
            'phone' => '01787878787',
            'designation' => "Deputy_manager_1",
            'status' => 'active',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($deputyManager);
    }
}
