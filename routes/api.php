<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApplicationController;

Route::get('/applications', [ApplicationController::class, 'list']);
Route::post('/applications', [ApplicationController::class, 'store']);
Route::get('/applications/{id}', [ApplicationController::class, 'show']);

