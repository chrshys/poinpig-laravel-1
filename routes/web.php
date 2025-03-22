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
        $user = auth()->user();
        $team = $user->currentTeam;
        
        // Check if the user is the owner of the team or has admin role
        if ($user->ownsTeam($team) || $user->hasTeamRole($team, 'admin')) {
            return Inertia::render('Family/Dashboard');
        } else {
            return Inertia::render('Family/UserDashboard');
        }
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
        $user = auth()->user();
        $team = $user->currentTeam;
        
        // Check if the user is the owner of the team or has admin role
        if ($user->ownsTeam($team) || $user->hasTeamRole($team, 'admin')) {
            return Inertia::render('Classroom/Dashboard');
        } else {
            return Inertia::render('Classroom/UserDashboard');
        }
    })->name('dashboard');
});
