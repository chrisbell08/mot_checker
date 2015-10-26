<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderType extends Model
{

    /**
     * [$table description]
     * @var string
     */
    protected $table = 'reminder_types';

    /**
     * [$guarded description]
     * @var array
     */
    protected $guarded = array( 'id' );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text'
    ];
}
