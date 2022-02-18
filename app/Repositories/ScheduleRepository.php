<?php

namespace App\Repositories;

use App\Models\ScheduleWorker;

class ScheduleRepository
{
    public function store($request)
    {
        // create shift for the worker
        $createdStatus = ScheduleWorker::create([
            'date' => $request->date,
            'shift_id' => $request->shift_id,
            'worker_id' => $request->worker_id,
        ]);

        return $createdStatus;
    }
}