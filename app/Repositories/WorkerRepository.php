<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ScheduleRepository
{
    public function getOne($workerId) {
        return DB::table('workers')->find($workerId);
    }

    public function getAll($model) {
        
    }


    public function store($model) {

    }
}