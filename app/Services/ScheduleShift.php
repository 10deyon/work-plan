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

        
        // check if worker already has shift for the day
        if ($worker->schedules) {
            throw new Exception('Worker is already assigned a shift for the provided date');
        }
        dd($worker->schedules);

        dd(count($worker->schedules) > 0);
        
        // check if shift is already running
        if (!$now->between($start, $end)) {
            throw new Exception('Shift is already on');
        }
        
        // check if worker already has shift for the day
        if ($request->date < $now->toDateString()) {
            throw new ModelNotFoundException('The shift time/day is over');
        }
        
        // create shift for the worker
        $createdStatus = Schedule::create([
            'date' => $request->date,
            'shift_id' => $request->shift_id,
            'worker_id' => $request->worker_id,
        ]);

        return $createdStatus;
    }
}