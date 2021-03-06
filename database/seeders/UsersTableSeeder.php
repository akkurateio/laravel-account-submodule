<?php

namespace Akkurate\LaravelAccountSubmodule\Database\Seeders;

use Akkurate\LaravelAccountSubmodule\Models\User;
use Illuminate\Database\Seeder;
use Akkurate\LaravelContact\Models\Type;
use Akkurate\LaravelAccountSubmodule\Models\Account;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('laravel-account-submodule.users') as $user) {
            if (App::environment() === 'production') {
                $password = Hash::make(Str::random(20));
            } else {
                $password = Hash::make(config('laravel-account-submodule.default-password'));
            }
            $newUser = User::updateOrCreate(
                [
                    'email' => $user['email']['address']
                ],
                [
                    'account_id' => $user['account_id'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'password' => $password,
                    'remember_token' => Str::random(10),
                    'is_active' => 1,
                    'activated_at' => now(),
                ]
            );
            $newUser->markEmailAsVerified();
            if (config('laravel-contact')) {
                $newUser->emails()->create([
                    'name' => $user['lastname'],
                    'type_id' => Type::where('code', $user['email']['type'])->first()->id,
                    'email' => $user['email']['address']
                ]);
                if (array_key_exists('phone', $user)) {
                    $newUser->phones()->create([
                        'type_id' => Type::where('code', $user['phone']['type'])->first()->id,
                        'number' => $user['phone']['number'],
                    ]);
                }
                if (array_key_exists('addresses', $user)) {
                    foreach ($user['addresses'] as $address) {
                        $newUser->addresses()->create([
                            'type_id' => Type::where('code', $address['type'])->first()->id,
                            'name' => $address['name'] ?? null,
                            'street1' => $address['street1'],
                            'zip' => $address['zip'],
                            'city' => $address['city'],
                        ]);
                    }
                }
            }

            if (array_key_exists('accounts', $user)) {
                foreach ($user['accounts'] as $accountName) {
                    $account = Account::where('name', $accountName)->first();
                    $newUser->accounts()->attach($account->id);
                }
            }

            $newUser->preference()->create();
        }
    }
}
