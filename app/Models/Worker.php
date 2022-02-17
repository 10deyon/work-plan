<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Worker extends Model
{
    use HasFactory;

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
        'name', 'email', 'employment_date'
    ];

    /**
    * The roles that belong to the user.
    */
    public function schedules() {
        return $this->hasMany(
            Schedule::class,  // Target model
            "worker_id",    // Foreign key on workers table...
            // "shift_id",    // Foreign key on shift table...
            "id"            // Local key on workers table
        );
    }
    
    /**
    * Shifts a user belongs
    *
    * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsToMany
    */
    public function shifts() {
        return $this->belongsToMany(
            Shift::class,   // Target model
            "schedule_workers", // Pivot Table name
            "worker_id",    // Foreign key on schedule_workers table...
            "shift_id", // Foreign key on schedule_workers table...
            "id",       // Local key on workers table...
        );
    }
}
