<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderLog extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'reminders';

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
        'reminder_id', 'user_id'
    ];

    /*
     * Join with the Reminder
     */
    public function reminder()
    {
        return $this->belongsTo('App\Http\Models\Reminder');
    }

    /*
     * Join with the user
     */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }
}
