<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class ScheduleTest extends TestCase
{
    use DatabaseMigrations;

    /*
    * Test to fetch all shifts
    *
    */
    public function test_fetch_all_available_shifts()
    {
        $res = $this->get('api/v1/shifts', []);
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
    * Test to shift to a worker
    *
    */
    public function test_assign_shift_to_a_worker()
    {
        $parameters = [
            "worker_id" => 40,
            "shift_id" => 3,
            "date" => "2022-02-19"
        ];

        $res = $this->post('api/v1/shifts', $parameters);
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
    * Test to validation for assigning shift parameters
    *
    */
    public function test_validate_assign_shift_params()
    {
        $parameters = [
            "worker_id" => 401,
            "shift_id" => 31,
            "date" => "2022-02-19"
        ];

        $res = $this->post('api/v1/shifts', $parameters, []);
        $res->seeStatusCode(400);

        $content = json_decode($res->response->getContent());
        $this->assertEquals($content->code, '02');

        $res->seeJsonStructure([
            'code',
            'message' => [
                'worker_id',
                'shift_id',
            ],
        ]);
    }

        /*
    * Test to check if the shift has already started
    *
    */
    public function test_if_shift_has_already_started()
    {
        $parameters = [
            "worker_id" => 40,
            "shift_id" => 3,
            "date" => "2022-02-18"
        ];

        $res = $this->post('api/v1/shifts', $parameters, []);
        $res->seeStatusCode(400);

        $content = json_decode($res->response->getContent());
        $this->assertEquals($content->code, '02');

        $res->seeJsonStructure([
            'code',
            'message'
        ]);
    }
    
    /*
    * Test to check if the shift time is over
    *
    */
    public function test_if_shift_is_already_over()
    {
        $parameters = [
            "worker_id" => 40,
            "shift_id" => 2,
            "date" => "2022-02-18"
        ];

        $res = $this->post('api/v1/shifts', $parameters, []);
        $res->seeStatusCode(400);

        $content = json_decode($res->response->getContent());
        $this->assertEquals($content->code, '02');

        $res->seeJsonStructure([
            'code',
            'message'
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
