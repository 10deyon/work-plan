<?php

namespace App\Services;

use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Worker;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ScheduleShift 
{
    /**
     * Filter service that checks by the provided value
     *
     * @param Model $model
     * @param  \Illuminate\Http\Request  $request
     * @return Array $query
     */
    public function scheduleWorkerShift($request)
    {
        $worker = Worker::find($request->worker_id);
        $shift = Shift::find($request->shift_id);

        $now = Carbon::now();
        $start = Carbon::createFromTimeString($shift->time_in);
        $end = Carbon::createFromTimeString($shift->time_out);
    
        // check if shift is already running
        if (!$now->between($start, $end)) {
            throw new Exception('Shift is already on');
        }

        // check if worker already has shift for the day
        if ($worker->schedule) {
            throw new ModelNotFoundException('This worker is currently serving a shift for the day');
        }
        
        // create shift for the worker
        $createdStatus = Schedule::create([
            'week_day' => $request->shift_day,
            'shift_id' => $request->shift_id,
            'worker_id' => $request->worker_id,
        ]);

        return $createdStatus;
    }
}