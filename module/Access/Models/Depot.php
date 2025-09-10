<?php

namespace Module\Access\Models;

use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    protected $fillable = [
        'name',
        'is_active'
    ];
}
