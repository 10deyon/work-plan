<?php

use App\Models\Worker;
use Laravel\Lumen\Testing\DatabaseMigrations;

class WorkerTest extends TestCase
{
    use DatabaseMigrations;

    /*
    * Test if a factory worker is created on the DB 
    *
    */    
    public function test_if_a_worker_is_created() {
        $worker = Worker::factory()->create();

        $worker->assertOk()->json();
    }

    // public function testHistoryService()
    // {
    //     $data = $this->createTransaction();
        
    //     $requestBody = [
    //         "start_date" => date('Y-m-d'),
    //         "end_date" => date('Y-m-d'),
    //     ];

    //     $page = 1;

    //     $res = self::fetchHistory(new PowerTransaction(), new OldPowerTransaction(), $requestBody, $page);
        
    //     $this->assertArrayHasKey("total", $res);
    //     $this->assertArrayHasKey("load_more", $res);
    //     $this->assertArrayHasKey("items", $res);

    //     $expectedCount = 1;
    //     $this->assertCount($expectedCount, $res['items'], "testArray doesn't contains 3 elements");
        
    //     $this->assertEquals(count($res['items']), $data->count());
    // }


    // private function loadProviders()
    // {
    //     $dataToStore = PowerProvider::create([
    //         'name' => 'Eko Disco ',
    //         'foreign_id' => 1,
    //         'slug' => 'EKO_DISCO',
    //         'created_at' => Carbon::now(),
    //         'updated_at' => Carbon::now(),
    //     ]);

    //     return $dataToStore;
    // }


    // private function loadPackages()
    // {
    //     $provider = $this->loadProviders();

    //     $dataToStore = PowerPackage::create([
    //         'foreign_id' => 1,
    //         'name' => 'Eko Disco ',
    //         'slug' => 'EKO_DISCO',
    //         'shortname' =>'ekedc_prepaid',
    //         'provider_id' => $provider->id,
    //         'created_at' => Carbon::now(),
    //         'updated_at' => Carbon::now(),
    //     ]);

    //     return $dataToStore;
    // }

    // private function createTransaction()
    // {
    //     $power = $this->loadPackages();

    //     $data = [
    //         'trace_id' => 8765462789,
    //         'transaction_id' => time() . rand(100, 1000),
    //         'phone_number' => '08012345678',
    //         'provider_id' => $power->provider_id,
    //         'package_id' => $power->id,
    //         'meter_number' => '04274108440',
    //         'amount' => 600,
    //         'email' => 'test@test.com',
    //         'meter_type' => 'prepaid',
    //         'status' => 'fulfilled',
    //         'request_time' => $date = date('D jS M Y, h:i:sa'),
    //         'date' => $date,
    //         "customer_name" => "John Doe",
    //         "provider" => "ikedc",
    //         "customer_address" => "madiana close",
    //         "token" => "256789201093258739",
    //         "unit" => "12.5",
    //     ];
        
    //     $data['client_request'] = json_encode($data);
        
    //     $transaction = PowerTransaction::create($data);
        
    //     return $transaction;
    // }
}
