<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/timezone-test', function () {
    return Date::now()->format('Y-m-d H:i:s');
});