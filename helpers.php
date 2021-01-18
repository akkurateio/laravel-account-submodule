<?php

if (!function_exists('currentAccount')) {
    function currentAccount()
    {

        $account = \App\Models\Account::where('slug', request('uuid'))
            ->with(['preference'])
            ->first();

        if(empty($account)) {
            $account = \App\Models\Account::where('slug', request('uuid') ?? auth()->user()->account->slug)
                ->with(['preference'])
                ->first();
        }

        return $account;
    }
}
