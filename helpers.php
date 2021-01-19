<?php

if (!function_exists('currentAccount')) {
    function currentAccount()
    {

        if(class_exists(\App\Models\Account::class)) {

            $account = \App\Models\Account::where('slug', request('uuid'))
                ->with(['preference'])
                ->first();

        } else {

            $account = \Akkurate\LaravelAccountSubmodule\Models\Account::where('slug', request('uuid'))
                ->with(['preference'])
                ->first();

        }

        if(empty($account)) {
            $account = auth()->user()->account;
        }

        return $account;

    }
}
