<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
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
        'shift_type', 'time_in', 'time_out'
    ];
    
    /**
     * Get the scheules that owns the shift.
     */
    public function schedules()
    {
        dd($this->id);
        return $this->belongsTo(Schedule::class)->where($this->id, 'shift_id')->get();
    }
}
