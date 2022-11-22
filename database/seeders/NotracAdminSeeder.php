<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class NotracAdminSeeder extends Seeder
{
    /**
     * Run the Notrac Admin basic setup database seed.
     *
     * @return void
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::create(['name' => 'access admin']);
        Permission::create(['name' => 'access cms']);
        Permission::create(['name' => 'view logs']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'manage content']);
        Permission::create(['name' => 'write article']);

        // Create Roles & assign Permissions
        // The super-admin permissions are handled by a global Gate inside the AuthServiceProvider boot method
        // Subscribers have no specific permissions (for now :-p)
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'webmaster'])->givePermissionTo('access cms', 'manage users', 'manage content');
        Role::create(['name' => 'editor'])->givePermissionTo('access cms', 'manage content');
        Role::create(['name' => 'writer'])->givePermissionTo('access cms', 'write article');
        Role::create(['name' => 'subscriber']);

        // Create super-admin user
        User::create([
            'first_name'        => 'Super',
            'last_name'         => 'Admin',
            'email'             => config('mail.from.address'),
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ])->assignRole('super-admin');

        // Create regular admin user
        User::create([
            'first_name'        => 'John',
            'last_name'         => 'Admin',
            'email'             => 'admin@test.local',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ])->assignRole('admin');

        // Create webmaster user
        User::create([
            'first_name'        => 'Web',
            'last_name'         => 'Master',
            'email'             => 'webmaster@test.local',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ])->assignRole('webmaster');

        // Create editor user
        User::create([
            'first_name'        => 'Joe',
            'last_name'         => 'Editor',
            'email'             => 'editor@test.local',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ])->assignRole('editor');

        // Create writer user with posts
        Post::factory()
            ->count(10)
            ->for(User::create([
                'first_name'        => 'Jack',
                'last_name'         => 'Writer',
                'email'             => 'writer@test.local',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
            ])->assignRole('writer'))
            ->create();

        // Create fake subscriber users
        $hashedUsers = User::factory(2)->hashed()->create();
        foreach ($hashedUsers as $user){
            $user->assignRole('subscriber');
        }
        $deletedUsers = User::factory(2)->deleted()->create();
        foreach ($deletedUsers as $user){
            $user->assignRole('subscriber');
        }
        $unverifiedUsers = User::factory(4)->unverified()->create();
        foreach ($unverifiedUsers as $user){
            $user->assignRole('subscriber');
        }
        $nonactiveUsers = User::factory(2)->nonactive()->create();
        foreach ($nonactiveUsers as $user){
            $user->assignRole('subscriber');
        }
        $subscriberUsers = User::factory(10)->create();
        foreach ($subscriberUsers as $user){
            $user->assignRole('subscriber');
        }
    }
}
