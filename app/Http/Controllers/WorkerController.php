<?php

namespace App\Http\Controllers;

use App\Models\Worker;

class WorkerController extends Controller
{
    /**
     * Method fetches list of all workers
     *
     * @return \Illuminate\Http\Response
     */
    public function getWorkers()
    {
        $workers = Worker::all();

        return self::returnSuccess($workers);
    }

    /**
     * Method fetches all Workers and respective shift
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllWorkersAndShift()
    {
        $workerShifts = Worker::with('scheduleWorkers.shift')->paginate(20);
        return self::returnSuccess($workerShifts);
    }

    /**
     * Method returns a specific worker and all shifts within a week
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingleWorkerAndShift($workerId)
    {
        $result = Worker::find($workerId);
        
        $dt = $result->with('scheduleWorkers.shift')->first();

        return self::returnSuccess($dt);
    }
}
