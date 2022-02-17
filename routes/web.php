<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () {
// 	$now = Carbon::now();

// 	$start = Carbon::createFromTimeString('22:00');
// 	$end = Carbon::createFromTimeString('08:00')->addDay();

// 	if ($now->between($start, $end)) {
// 		return response()->json('¯\_(ツ)_/¯');
// 	}
// 	return response()->json();

// 	// $dt = Carbon::create(2022, 1, 31, 0);

// 	$dt = Carbon::now();
// 	// var_dump($dt->hour);
// 	echo $dt->toTimeString();


// 	// $dateOfSunday = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->hour(0)->minute(0)->seconds(0)->subWeek(1); // 12:00AM on Last Sunday
// 	// $dateOfSaturday = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->minute(59)->hour(23)->second(59)->addDays(6)->subWeek(1); // 11:59:59PM on Saturday

// 	// return response()->json(Carbon::now());
// 	// return response()->json($dateOfSunday);
// 	// return response()->json($dateOfSaturday);

// 	// return redirect()->route('health');
// });

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {	
	$router->group(['prefix' => 'workers'], function () use ($router) {
		$router->get('/', 'WorkerController@getWorkers');
		$router->get('/{workerId}/shift', 'WorkerController@getSingleWorkerAndShift');
		$router->get('/shift', 'WorkerController@getAllWorkersAndShift');
	});

	$router->group(['prefix' => 'shifts'], function () use ($router) {
		$router->get('/', 'ShiftController@getShifts');
		$router->get('/histories', 'ShiftController@filterWorkerByShiftValue');
		$router->post('/', 'ShiftController@asignShift');
		
		// $router->get('/{shiftId}/worker/{workerId}', 'ShiftController@asignShift');
		// $router->put('/', 'ShiftController@asignShift');
	});
});
