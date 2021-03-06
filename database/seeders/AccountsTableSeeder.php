<?php

namespace Akkurate\LaravelAccountSubmodule\Database\Seeders;

use Akkurate\LaravelContact\Models\Type;
use Akkurate\LaravelAccountSubmodule\Models\Account;
use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('laravel-account-submodule.accounts') as $key => $account) {

            $accountParams = !empty($account['params']) ? json_encode($account['params']) : null;

            $newAccount = Account::updateOrCreate(
                [
                    'email' => $account['email']
                ],
                [
                    'name' => $account['name'],
                    'params' => $accountParams,
                    'website' => $account['website'] ?? null,
                    'parent_id' => $account['parent_id'] ?? null
                ]
            );

            if (config('laravel-contact')) {
                if (array_key_exists('phones', $account)) {
                    foreach ($account['phones'] as $phone) {
                        $phone = $newAccount->phones()->create([
                            'type_id' => Type::where('code', $phone['type'])->first() ? Type::where('code', $phone['type'])->first()->id : factory(Type::class)->create()->id,
                            'number' => $phone['number'],
                        ]);
                        $newAccount->update(['phone_id' => $phone->id]);
                    }
                }
                if (array_key_exists('addresses', $account)) {
                    foreach ($account['addresses'] as $address) {
                        $address = $newAccount->addresses()->create([
                            'type_id' => Type::where('code', $address['type'])->first() ? Type::where('code', $address['type'])->first()->id : factory(Type::class)->create()->id,
                            'name' => $address['name'],
                            'street1' => $address['street1'],
                            'zip' => $address['zip'],
                            'city' => $address['city']
                        ]);
                        $newAccount->update(['address_id' => $address->id]);
                    }
                }
                if (array_key_exists('emails', $account)) {
                    foreach ($account['emails'] as $email) {
                        $email = $newAccount->emails()->create([
                            'type_id' => Type::where('code', $email['type'])->first() ? Type::where('code', $email['type'])->first()->id : factory(Type::class)->create()->id,
                            'name' => $email['name'],
                            'email' => $email['email']
                        ]);
                        $newAccount->update(['email_id' => $email->id]);
                    }
                }
            }

            $newAccount->preference()->create([
                'pagination' => isset($account['preference']['pagination']) ? $account['preference']['pagination'] : 30
            ]);
        }
    }
}
