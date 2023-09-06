<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test',function (){
    try {

        return 'done';
    }catch (\Exception $exception){
        die($exception->getMessage());
    }
});

function stringToKey($string) : string {
    return trim(str_replace(" ", "_", $string));
}
