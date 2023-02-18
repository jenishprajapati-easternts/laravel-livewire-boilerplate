<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby_user extends Model
{
    public $timestamps = false;

    public $table = 'hobby_user';
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'hobby_id'];

}
