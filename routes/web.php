<?php

use App\Http\Controllers\landingpageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TraineeCompleteProfileController;
use App\Http\Controllers\TrainerCompleteProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainerWorkoutController;
use App\Http\Controllers\TrainerHomeController;
use App\Http\Controllers\TrainerMealplanController;
use App\Http\Controllers\TrainerProgressController;

use App\Http\Controllers\TraineeHomeController;
use App\Http\Controllers\TraineeWorkoutController;
use App\Http\Controllers\TraineeMealplanController;


Route::get('/', [landingpageController::class, 'index']);
Route::get('/contact', [landingpageController::class, 'contact']);
Route::get('/loginregis/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/loginregis/login', [AuthController::class, 'login']);
Route::get('/loginregis/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/loginregis/register', [AuthController::class, 'register']);
Route::get('/completeprofile/traineeprofile', [TraineeCompleteProfileController::class, 'showProfileForm'])->name('profile');
Route::post('/completeprofile/traineeprofile', [TraineeCompleteProfileController::class, 'saveProfile']);
Route::get('/completeprofile/trainerprofile', [TrainerCompleteProfileController::class, 'showProfileForm'])->name('trainer.profile');
Route::post('/completeprofile/trainerprofile', [TrainerCompleteProfileController::class, 'saveProfile']);
Route::get('/trainer/workout', [TrainerWorkoutController::class, 'index'])->name('trainer.workout');
Route::post('/trainer/workout', [TrainerWorkoutController::class, 'handleForm']);
Route::get('/trainer/home', [TrainerHomeController::class, 'index'])->name('trainer.home');
Route::get('/trainer/mealplan', [TrainerMealplanController::class, 'index'])->name('trainer.mealplan');
Route::post('/trainer/mealplan', [TrainerMealplanController::class, 'store'])->name('trainer.mealplan.store');
Route::get('/trainer/progress', [TrainerProgressController::class, 'index'])->name('trainer.progress');


Route::get('/trainee/home', [TraineeHomeController::class, 'showHome'])->name('trainee/home');
Route::post('/trainee/home', [TraineeHomeController::class, 'calculateBMI']);
Route::get('/trainee/workout', [TraineeWorkoutController::class, 'index'])->name('trainee.workout');
Route::get('/trainee/mealplan', [TraineeMealplanController::class, 'index'])->name('mealplan');