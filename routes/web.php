<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('generador');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/login', function () {
    return view('pages.auth.login');
});

