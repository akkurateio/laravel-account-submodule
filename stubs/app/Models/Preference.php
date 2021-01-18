<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    protected $table = 'admin_preferences';
    protected $fillable = ['target', 'pagination'];
    protected $hidden = ['preferenceable_id', 'preferenceable_type'];

    public function preferenceable()
    {
        return $this->morphTo();
    }
}
