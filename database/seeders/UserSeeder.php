<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create developer
        $developerRoleId = Role::where('slug', 'developer')->first()->id;
        $first_name = 'Asikul Islam';
        $last_name = 'Sazzat';
        User::updateOrCreate([
            'role_id' => $developerRoleId,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'slug' => Str::slug($first_name . ' ' . $last_name),
            'email' => 'developer@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ]);

        //create administrator
        $administratorRoleId = Role::where('slug', 'administrator')->first()->id;
        $first_name = 'System Admin';
        $last_name = 'Name';
        User::updateOrCreate([
            'role_id' => $administratorRoleId,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'slug' => Str::slug($first_name . ' ' . $last_name),
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ]);

        //create user
        $userRoleId = Role::where('slug', 'user')->first()->id;
        $users = [
            [
                'first_name' => 'Arnold',
                'last_name' => 'J. Burris',
                'slug' => Str::slug($first_name . ' ' . $last_name),
                'email' => 'user1@gmail.com',
            ],
            [
                'first_name' => 'Eva',
                'last_name' => 'Clark',
                'slug' => Str::slug($first_name . ' ' . $last_name),
                'email' => 'user2@gmail.com',
            ],
            [
                'first_name' => 'Tristan',
                'last_name' => 'Sandover',
                'slug' => Str::slug($first_name . ' ' . $last_name),
                'email' => 'user3@gmail.com',
            ],
            [
                'first_name' => 'Paige',
                'last_name' => 'Payne',
                'slug' => Str::slug($first_name . ' ' . $last_name),
                'email' => 'user4@gmail.com',
            ],
            [
                'first_name' => 'Olivia',
                'last_name' => 'Clucas',
                'slug' => Str::slug($first_name . ' ' . $last_name),
                'email' => 'user5@gmail.com',
            ],
            [
                'first_name' => 'Finlay',
                'last_name' => 'Barker',
                'slug' => Str::slug($first_name . ' ' . $last_name),
                'email' => 'user6@gmail.com',
            ],
        ];
        foreach ($users as $user) {
            User::updateOrCreate([
                'role_id' => $userRoleId,
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'slug' => Str::slug($user['first_name'] . ' ' . $user['last_name']),
                'email_verified_at' => now(),
                'password' => Hash::make('1234'),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
