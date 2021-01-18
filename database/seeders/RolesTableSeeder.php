<?php

namespace Akkurate\LaravelAccountSubmodule\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('laravel-account-submodule.roles') as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                ['label' => $role['label'] ?? null]
            );
        }
    }

}
