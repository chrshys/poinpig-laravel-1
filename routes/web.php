<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Family-specific routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'team.type:family'
])->prefix('family')->name('family.')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Family/Dashboard');
    })->name('dashboard');
});

// Classroom-specific routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'team.type:classroom'
])->prefix('classroom')->name('classroom.')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Classroom/Dashboard');
    })->name('dashboard');
});
