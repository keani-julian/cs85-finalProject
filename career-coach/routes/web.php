<?php

use App\Http\Controllers\CoachController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CoachController::class, 'create'])->name('coach.create');
Route::post('/coach', [CoachController::class, 'store'])->name('coach.store');
Route::get('/history', [CoachController::class, 'index'])->name('coach.index');
Route::get('/submissions/{submission}', [CoachController::class, 'show'])->name('coach.show');
Route::delete('/submissions/{submission}', [CoachController::class, 'destroy'])->name('coach.destroy');
