<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'name', 'country_id',
    ];

    /**
     * Lightweight response variable
     *
     * @var array
     */
    public $light = [
        'id', 'name',
    ];

    /**
     * @var array
     */
    public $sortable = [
        'name',
    ];

    /**
     * @var array
     */
    public $foreign_sortable = [
        'country_id',
    ];

    /**
     * @var array
     */
    public $foreign_table = [
        'countries',
    ];

    /**
     * @var array
     */
    public $foreign_key = [
        'name',
    ];

    /**
     * @var array
     */
    public $foreign_method = [
        'country',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
        'id' => 'string',
        'country_id' => 'string',
        'name' => 'string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
