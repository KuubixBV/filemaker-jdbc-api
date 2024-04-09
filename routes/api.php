<?php

use App\Http\Controllers\JdbcController;
use Illuminate\Support\Facades\Route;

Route::post('/make-request', [JdbcController::class, 'proxyData']);
