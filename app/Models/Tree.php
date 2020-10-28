<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{

    protected $table = 'tree';

    protected $fillable = [
        'name',
        'avatar_url',
        'description',
        'user_id',
    ];

    protected function items()
    {
        return $this->hasMany('App\Models\TreeItems');
    }

    protected function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
