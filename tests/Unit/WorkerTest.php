<?php

use App\Models\Worker;
use Laravel\Lumen\Testing\DatabaseMigrations;

class WorkerTest extends TestCase
{
    use DatabaseMigrations;

    /*
    * Test to fetch all workers in the system
    *
    */
    public function test_fetch_all_available_worker()
    {
        $res = $this->get('api/v1/workers', []);
        $res->seeStatusCode(200);

        $content = json_decode($res->response->getContent());
        $this->assertEquals(strtolower($content->message), 'successful');
        $this->assertEquals($content->code, '00');

        $res->seeJsonStructure([
            'code',
            'message',
            'data' 
            // => ['*' =>
            //     [
            //         'id',
            //         'name',
            //         'email',
            //         'employment_date',
            //     ]
            // ],
            // 'meta' => [
            //     '*' => [
            //         'total',
            //         'count',
            //         'per_page',
            //         'current_page',
            //         'total_pages',
            //         'links',
            //     ]
            // ]
        ]);
    }

    /*
    * Test to fetch all workers in the system
    *
    */
    public function test_fetch_a_single_worker_with_schedules()
    {
        $res = $this->get('api/v1/workers/1/schedules');

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
        $res = $this->get('api/v1/workers/schedules');

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
