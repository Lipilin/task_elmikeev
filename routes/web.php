<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::group(['prefix' => 'api'], function(){
	Route::get('/stocks', [ApiController::class, 'get_entity']);
	Route::get('/incomes', [ApiController::class, 'get_entity']);
	Route::get('/sales', [ApiController::class, 'get_entity']);
	Route::get('/orders', [ApiController::class, 'get_entity']);
});
