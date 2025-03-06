<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('layouts.admin');
    })->name('admin.dashboard');
});
