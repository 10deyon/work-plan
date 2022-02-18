<?php

namespace App\Services;

use App\Models\ScheduleWorker;
use App\Models\Shift;
use App\Models\Worker;
use App\Repositories\ScheduleRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ScheduleShift 
{
    protected $scheduleRepo;
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepo = $scheduleRepo;
    }

    /**
     * Filter service that checks by the provided value
     *
     * @param Model $model
     * @param  \Illuminate\Http\Request  $request
     * @throws \Exception
     * @return Array $query
     */
    public function scheduleWorkerShift($request)
    {
        $worker = Worker::find($request->worker_id);
        $shift = Shift::find($request->shift_id);

        $assigned = $worker->scheduleWorkers()
            ->where([
                ['worker_id', '=', $request->worker_id],
                ['date', '=', $request->date]])
            ->first();

        // check if worker already has shift for the day
        if ($assigned) {
            throw new Exception('Worker already assigned a shift for the provided date');
        }
        
        self::checkShiftStatus($shift, $request);
        
        return $this->scheduleRepo->store($request);
    }

    /**
     * Check the status of a shift before assignment
     *
     * @param $shift
     * @param  \Illuminate\Http\Request  $request
     * @throws \Exception
     * @return void
     */
    static function checkShiftStatus($shift, $request)
    {
        $now = Carbon::now();
        $start = Carbon::createFromTimeString($shift->time_in)->toDateTimeString();
        $end = Carbon::createFromTimeString($shift->time_out)->toDateTimeString();

        if ($now->addHour()->between($start, $end, true) && $now->toDateString() === $request->date) {
            throw new Exception('Shift is already on');
        }
        
        // check if worker already has shift for the day
        if ($request->date < $now->toDateString()) {
            throw new Exception('The shift time/day is over');
        }
    }
}