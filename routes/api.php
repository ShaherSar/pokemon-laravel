<?php

use Illuminate\Support\Facades\Route;

Route::resource('Animals', \App\Http\Controllers\AnimalController::class)->except([
    'edit',
    'create'
]);