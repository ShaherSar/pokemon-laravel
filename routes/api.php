<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

Route::resource('animals', AnimalController::class)->except([
    'edit',
    'create'
]);