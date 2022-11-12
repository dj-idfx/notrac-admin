<?php

namespace Database\Seeders;

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
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage content']);

        // Create Roles & assign Permissions
        // The super-admin role's permissions is handled by a global Gate inside the AuthServiceProvider boot method
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'webmaster'])->givePermissionTo('access cms', 'manage users', 'manage content');
        Role::create(['name' => 'editor'])->givePermissionTo('access cms', 'manage content');
        Role::create(['name' => 'subscriber']);

        // Create super-admin user
        User::create([
            'first_name'        => 'Web',
            'last_name'         => 'Master',
            'email'             => config('mail.from.address'),
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ])->assignRole('super-admin');

        // Create fake users
        $adminUsers = User::factory(2)->create();
        foreach ($adminUsers as $user){
            $user->assignRole('admin');
        }

        $webmasterUsers = User::factory(3)->create();
        foreach ($webmasterUsers as $user){
            $user->assignRole('webmaster');
        }

        $editorUsers = User::factory(4)->create();
        foreach ($editorUsers as $user){
            $user->assignRole('editor');
        }

        $subscriberUsers = User::factory(20)->create();
        foreach ($subscriberUsers as $user){
            $user->assignRole('subscriber');
        }
        $unverifiedUsers = User::factory(5)->unverified()->create();
        foreach ($unverifiedUsers as $user){
            $user->assignRole('subscriber');
        }
        $nonactiveUsers = User::factory(5)->nonactive()->create();
        foreach ($nonactiveUsers as $user){
            $user->assignRole('subscriber');
        }
    }
}
