<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingpageController;
use App\Http\Controllers\TraineeCompleteProfileController;
use App\Http\Controllers\TrainerCompleteProfileController;
use App\Http\Controllers\TrainerWorkoutController;
use App\Http\Controllers\TrainerHomeController;
use App\Http\Controllers\TrainerMealplanController;
use App\Http\Controllers\TrainerProgressController;
use App\Http\Controllers\TraineeHomeController;
use App\Http\Controllers\TraineeWorkoutController;
use App\Http\Controllers\TraineeMealplanController;
use App\Http\Controllers\TraineeFeedbackController;
use App\Http\Controllers\TraineeNotificationController;
use App\Http\Controllers\TrainerNotificationController;
use App\Http\Controllers\TrainerProfileController;
use App\Http\Controllers\TrainerFeedbackController;
use App\Http\Controllers\TraineeProfileController;
use App\Http\Controllers\InviteTrainerController;
use App\Http\Controllers\TrainerRegistController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TraineeRegistController;
use App\Http\Middleware\CheckProfileComplete;

// ------------------------
// Public Routes
// ------------------------

Route::get('/', [landingpageController::class, 'index']);
Route::get('/contact', [landingpageController::class, 'contact']);

Route::get('/loginregis/invite', [InviteTrainerController::class, 'showForm'])->name('trainer.invite.show');
Route::post('/loginregis/invite', [InviteTrainerController::class, 'verifyCode'])->name('trainer.invite.verify');

Route::get('/loginregis/TrainerRegist', [TrainerRegistController::class, 'showForm'])->name('trainer.register.form');
Route::post('/loginregis/TrainerRegist', [TrainerRegistController::class, 'register'])->name('trainer.register.submit');

Route::get('/loginregis/TraineeRegist', [TraineeRegistController::class, 'showForm'])->name('trainee.register.form');
Route::post('/loginregis/TraineeRegist', [TraineeRegistController::class, 'register'])->name('trainee.register.submit');

Route::get('/loginregis/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/loginregis/login', [LoginController::class, 'login'])->name('login.process');

// ------------------------
// Authenticated Routes
// ------------------------

// Profile Completion Routes
Route::get('/completeprofile/traineeprofile', [TraineeCompleteProfileController::class, 'show'])->name('trainee.profile.complete');
Route::post('/completeprofile/traineeprofile', [TraineeCompleteProfileController::class, 'update'])->name('trainee.profile.complete.store');

Route::get('/completeprofile/trainerprofile', [TrainerCompleteProfileController::class, 'showProfileForm'])->name('trainer.profile.complete');
Route::post('/completeprofile/trainerprofile', [TrainerCompleteProfileController::class, 'saveProfile'])->name('trainer.profile.complete.store');

// Routes that require auth and profile complete middleware
Route::middleware(['auth', CheckProfileComplete::class])->group(function () {

    // --- Trainee Routes ---
    Route::get('/trainee/home', [TraineeHomeController::class, 'showHome'])->name('trainee.home');
    Route::post('/trainee/home', [TraineeHomeController::class, 'calculateBMI']);

    Route::get('/trainee/workout', [TraineeWorkoutController::class, 'index'])->name('trainee.workout');
    Route::get('/trainee/mealplan', [TraineeMealplanController::class, 'index'])->name('trainee.mealplan');

    Route::get('/trainee/profile', [TraineeProfileController::class, 'index'])->name('trainee.profile');
    Route::post('/trainee/profile', [TrainerCompleteProfileController::class, 'saveProfile'])->name('trainee.profile.save');
    Route::get('/trainee/profile/edit', [TraineeProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/trainee/notification', [TraineeNotificationController::class, 'index'])->name('trainee.notification');
    Route::post('/trainee/notification', [TraineeNotificationController::class, 'store'])->name('trainee.notification.store');

    Route::get('/trainee/feedback', [TraineeFeedbackController::class, 'showForm'])->name('trainee.feedback');
    Route::post('/trainee/feedback', [TraineeFeedbackController::class, 'submitForm'])->name('trainee.feedback.submit');

    // --- Trainer Routes ---
    Route::get('/trainer/home', [TrainerHomeController::class, 'index'])->name('trainer.home');

    Route::get('/trainer/workout', [TrainerWorkoutController::class, 'index'])->name('trainer.workout');
    Route::post('/trainer/workout', [TrainerWorkoutController::class, 'handleForm']);

    Route::get('/trainer/mealplan', [TrainerMealplanController::class, 'index'])->name('trainer.mealplan');
    Route::post('/trainer/mealplan', [TrainerMealplanController::class, 'store'])->name('trainer.mealplan.store');

    Route::get('/trainer/progress', [TrainerProgressController::class, 'index'])->name('trainer.progress');

    Route::get('/trainer/profile', [TrainerProfileController::class, 'show'])->name('trainer.profile');
    Route::post('/trainer/profile', [TrainerCompleteProfileController::class, 'saveProfile'])->name('trainer.profile.save');
    Route::get('/trainer/profile/edit', [TrainerProfileController::class, 'edit'])->name('trainer.profile.edit');

    Route::get('/trainer/feedback', [TrainerFeedbackController::class, 'index'])->name('trainer.feedback');

    Route::get('/trainer/notification', [TrainerNotificationController::class, 'index'])->name('trainer.notification');
    Route::post('/trainer/notification', [TrainerNotificationController::class, 'update'])->name('trainer.notification.update');

});
