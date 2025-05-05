<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainerWorkoutController;
use App\Http\Controllers\TrainerHomeController;
use App\Http\Controllers\TrainerMealplanController;

use App\Http\Controllers\TraineeWorkoutController;

Route::get('/trainer/workout', [TrainerWorkoutController::class, 'index'])->name('trainer.workout');
Route::post('/trainer/workout', [TrainerWorkoutController::class, 'handleForm']);
Route::get('/trainer/home', [TrainerHomeController::class, 'index'])->name('trainer.home');
Route::get('/trainer/mealplan', [TrainerMealplanController::class, 'index'])->name('trainer.mealplan');
Route::post('/trainer/mealplan', [TrainerMealplanController::class, 'store'])->name('trainer.mealplan.store');

Route::get('/trainee/workout', [TraineeWorkoutController::class, 'index'])->name('trainee.workout');