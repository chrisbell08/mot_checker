<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserReminder extends Model
{
    use SoftDeletes;

    /**
     * [$table description]
     * @var string
     */
    protected $table = 'user_reminders';

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
        'user_id', 'reminder_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    /*
     * Join with user model
     */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }

    /*
     * Join with the reminder model
     */
    public function reminder()
    {
        return $this->belongsTo('App\Http\Models\Reminder');
    }
}
