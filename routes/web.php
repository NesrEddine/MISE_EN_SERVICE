<?php

use App\Livewire\Form;

\Illuminate\Support\Facades\Route::get('form', Form::class);


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/service', function () {
    return view('service');
})->name('service');
