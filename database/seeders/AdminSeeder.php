<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('publish articles');
        $role2->givePermissionTo('unpublish articles');
        $role2->givePermissionTo('edit articles');
        $role2->givePermissionTo('delete articles');

        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users


        $user = User::factory()->create([
            'profile_image' => null,
            'name' => 'Administrator',
            'address' => 'Bohol',
            'email' => 'admin@gmail.com',
            'gender' => 'Female',
            'phone_number' => '09512072888',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'profile_image' => null,
            'name' => 'Juan Dela Cruz',
            'address' => 'Cebu City',
            'email' => 'user@gmail.com',
            'gender' => 'Male',
            'phone_number' => '09092002123',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role1);
    }
}
