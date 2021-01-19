<?php

namespace Akkurate\LaravelAccountSubmodule\Traits;

use Akkurate\LaravelAccountSubmodule\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasUser
 */
trait HasUser
{
    public function user()
    {
        if (class_exists(\App\Models\User::class)) {
            return $this->belongsTo(\App\Models\User::class);
        }
        return $this->belongsTo(User::class);
    }
}
