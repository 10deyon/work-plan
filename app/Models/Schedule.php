<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * protected var
     * Table Name
     */
    protected $table = 'schedule_workers';
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shift_id', 'worker_id', 'week_day'
    ];
    
    /**
     * Get the worker that belongs to a shift.
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
    
    /**
     * Get the shifts for the Schedule.
     */
    public function shifts()
    {
        dd("here");
        return $this->hasMany(Shift::class)->with('shifts');
    }
}
