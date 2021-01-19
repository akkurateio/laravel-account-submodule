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

if (!function_exists('account')) {
    /**
     * @return \Akkurate\LaravelAccountSubmodule\Models\Account|\App\Models\Account
     */
    function account()
    {

        if(class_exists(\App\Models\Account::class)) {

            return new \App\Models\Account();
        }

        return new \Akkurate\LaravelAccountSubmodule\Models\Account();
    }
}

if (!function_exists('accountClass')) {
    /**
     * @return string
     */
    function accountClass(): string
    {

        if(class_exists(\App\Models\Account::class)) {

            return \App\Models\Account::class;
        }

        return \Akkurate\LaravelAccountSubmodule\Models\Account::class;
    }
}

if (!function_exists('user')) {
    /**
     * @return \Akkurate\LaravelAccountSubmodule\Models\User|\App\Models\User
     */
    function user()
    {

        if(class_exists(\App\Models\User::class)) {

            return new \App\Models\User();
        }

        return new \Akkurate\LaravelAccountSubmodule\Models\User();
    }
}

if (!function_exists('userClass')) {
    /**
     * @return string
     */
    function userClass(): string
    {

        if(class_exists(\App\Models\User::class)) {

            return \App\Models\User::class;
        }

        return \Akkurate\LaravelAccountSubmodule\Models\User::class;
    }
}
