<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleWorker extends Model
{
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shift_id', 'worker_id', 'date'
    ];
    
    public function shift() {
        return $this->belongsTo(Shift::class);
    }

    /**
     * Get the workers that belongs to a Schedule
     */
    public function workers () {
        return $this->belongsTo(Worker::class, 'worker_id');
    }
}
