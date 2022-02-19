<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Services\FilterService;
use App\Services\ScheduleShift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    protected $filterService, $scheduleShift;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FilterService $filterService, ScheduleShift $scheduleShift)
    {
        $this->filterService = $filterService;
        $this->scheduleShift = $scheduleShift;
    }

    /**
     * Method fetches all available shifts data
     *
     * @return \Illuminate\Http\Response
     */
    public function getShifts()
    {
        $shifts = Shift::with('schedules.workers')->get();

        return self::returnSuccess($shifts);
    }

    /**
     * Method fetches all available shifts data
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function asignShift(Request $request)
    {
        $isErrored =  self::validateRequestParams($request->all(), self::$ShiftValidationRule);
		if ($isErrored) return $this->returnFailed($isErrored);

        try {
            $scheduled = $this->scheduleShift->scheduleWorkerShift($request);

            return $this->returnSuccess($scheduled);
        } catch (\Exception $e) {
            return $this->returnFailed($e->getMessage(), 400);
        }
    }

    /**
     * Filters workers by specific shift value(s)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterWorkerByShiftValue(Request $request)
    {
        $isErrored =  self::validateRequestParams($request->all(), self::$FilterValidationRule);
		if ($isErrored) return $this->returnFailed($isErrored);
        
        $query = $this->filterService->filterMethod(new Shift(), $request);

        return self::returnSuccess($query, 'Successful');
    }
}
