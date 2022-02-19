<?php

namespace App\Http\Controllers;

use App\Models\Worker;

class WorkerController extends Controller
{
    /**
     * Method fetches all Workers and respective shift
     *
     * @return \Illuminate\Http\Response
     */
    public function getWorkersAndSchedules()
    {
        $workerShifts = Worker::with('schedules.shift')->paginate(20);
        return self::returnSuccess($workerShifts);
    }

    /**
     * Method returns a specific worker and all shifts within a week
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingleWorker($workerId)
    {
        $data = Worker::with('schedules.shift')->where('id', $workerId)->first();

        return self::returnSuccess($data);
    }
}
