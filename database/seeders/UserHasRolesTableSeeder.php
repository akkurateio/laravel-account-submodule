<?php

namespace Akkurate\LaravelAccountSubmodule\Database\Seeders;

use Akkurate\LaravelAccountSubmodule\Models\User;
use Illuminate\Database\Seeder;

class UserHasRolesTableSeeder extends seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('laravel-account-submodule.users') as $user) {
            $newUser = User::where('email', $user['email']['address'])->first();
            $newUser->assignRole($user['role']);
        }
    }
}
