<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WeatherController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/weather', [WeatherController::class, 'getWeather']);

Route::get('/teste', [WeatherController::class, 'testgetWeather']);

