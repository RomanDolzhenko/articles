<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])
    ->name('main.index');

require __DIR__ . '/auth.php';
