<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shifts = [
            [
                "shift_type" => "morning",
                "time_in" => "00:00",
                "time_out"=> "08:00"
            ],
            [
                "shift_type" => "noon",
                "time_in" => "08:00",
                "time_out"=> "16:00"
            ],
            [
                "shift_type" => "night",
                "time_in" => "16:00",
                "time_out"=> "24:00"
            ],
        ];

        DB::table("shifts")->truncate();

        foreach($shifts as $shift) {
            DB::table("shifts")->insert([
                "shift_type" => $shift['shift_type'],
                "time_in" => $shift['time_in'],
                "time_out" => $shift['time_out'],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]);
        }
    }
}
