<?php

namespace App\Models;

use Baum\Node;

class Position extends Node
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'positions';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

 	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];

    protected $guarded = ['id'];

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }
}
