<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminders extends Model
{
    use SoftDeletes;

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
       'label', 'method_id', 'interval_id', 'type_id'
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
     * Join with the Reminder method
     */
    public function method()
    {
        return $this->belongsTo('App\Http\Models\ReminderMethod', 'method_id');
    }

    /*
     * Join with the Reminder type
     */
    public function type()
    {
        return $this->belongsTo('App\Http\Models\ReminderType', 'type_id');
    }

    /*
     * Join with the Reminder interval
     */
    public function interval()
    {
        return $this->belongsTo('App\Http\Models\ReminderInterval', 'interval_id');
    }

}
