<?php

namespace App\Services;

class FilterService 
{
    /**
     * Filter service that checks by the provided value
     *
     * @param Model $model
     * @param  \Illuminate\Http\Request  $request
     * @return Array $query
     */
    public function filterMethod($model, $request)
    {
        $query = $model::query();
        
        $query->when(isset($request->start_date), function ($query) use ($request) {
            $query->where("created_at", ">=", $request->start_date . " 00:00:00");
        });

        $query->when(isset($request->shift_type) && ($request->shift_type != "all"), function ($query) use ($request) {
            $query->where("shift_type", "=", $request->shift_type);
        });
        
        $query->when(isset($request->end_date), function ($query) use ($request) {
            $query->where("created_at", "<=", $request->end_date . " 23:59:59");
        });

        $query->when(isset($request->shift_id), function ($query) use ($request) {
            $query->where("id", "=", $request->shift_id);
        });
        
        $query = $query->with('schedules.workers')->paginate(20);
        
        return $query;
    }
}