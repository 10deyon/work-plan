<?php

use App\Models\Schedule;
use App\Models\Shift;
use App\Models\Worker;
use Carbon\Carbon;
use Laravel\Lumen\Testing\DatabaseMigrations;

class WorkerTest extends TestCase
{
    use DatabaseMigrations;
    
    /*
    * Test to fetch all workers in the system
    *
    */
    public function test_fetch_a_single_worker_with_schedules()
    {
        $shift = Shift::create([
            "shift_type" => "morning",
            "time_in" => Carbon::now()->subHour(2)->toTimeString(),
            "time_out" => Carbon::now()->addHour(6)->toTimeString(),
        ]);

        $worker = Worker::factory()->create();
        
        Schedule::create([
            "worker_id" => $worker->id,
            "shift_id" => $shift->id,
            "date" => "2022-02-19"
        ]);

        $res = $this->get('api/v1/workers/1');

        $res->seeStatusCode(200);

        $content = json_decode($res->response->getContent());
        $this->assertEquals(strtolower($content->message), 'successful');
        $this->assertEquals($content->code, '00');

        $res->seeJsonStructure([
            'code',
            'message',
            'data'
        ]);
    }


    /*
    * Test to fetch all workers in the system
    *
    */
    public function test_fetch_workers_with_schedules()
    {
        $res = $this->get('api/v1/workers');

        $res->seeStatusCode(200);

        $content = json_decode($res->response->getContent());
        $this->assertEquals(strtolower($content->message), 'successful');
        $this->assertEquals($content->code, '00');

        $res->seeJsonStructure([
            'code',
            'message',
            'data'
        ]);
    }
}
