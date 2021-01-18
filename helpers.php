<?php

if (!function_exists('currentAccount')) {
    function currentAccount()
    {

        if(! class_exists(\App\Models\Account::class)) {
            return null;
        }

        $account = \App\Models\Account::where('slug', request('uuid'))
            ->with(['preference'])
            ->first();

        if(empty($account)) {
            $account = \App\Models\Account::where(auth()->user()->account->slug)
                ->with(['preference'])
                ->first();
        }

        return $account;
    }
}
