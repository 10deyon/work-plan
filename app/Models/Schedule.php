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
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shift_id', 'worker_id', 'date'
    ];
    
    public function shifts()
    {
        $this -> hasOne(Shift::class);
    }
}
