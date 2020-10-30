<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreeItem extends Model
{

    protected $table = 'tree_item';

    protected $fillable = [
        'name',
        'last_name',
        'patronymic',
        'data_of_birth',
        'data_of_death',
        'gender',
        'father_parent_id',
        'mother_parent_id',
        'adopted',
        'avatar_url',
        'description',
        'tree_id',
    ];



    protected function tree()
    {
        return $this->belongsTo('App\Models\TreeItems');
    }


}
