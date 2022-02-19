<?php

namespace App\Repositories;

use App\Models\Schedule;

class ScheduleRepository
{
    public function store($request)
    {
        // create shift for the worker
        $createdStatus = Schedule::create([
            'date' => $request->date,
            'shift_id' => $request->shift_id,
            'worker_id' => $request->worker_id,
        ]);

        return $createdStatus;
    }
}