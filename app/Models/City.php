<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'state_id',
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
        'state_id',
    ];

    /**
     * @var array
     */
    public $foreign_table = [
        'states',
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
        'state',
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
        'state_id' => 'string',
        'name' => 'string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
