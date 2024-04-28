<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'rai'])->name('home');
Route::get('/account/register',[AccountController::class,'registrarion'])->name('account.registration')->middleware('redirectauthenticate');

Route::post('/account/process-register',[AccountController::class,'processRegistration'])->name('account.processRegistration');

Route::get('/account/login',[AccountController::class,'login'])->name('account.login')->middleware('redirectauthenticate');

Route::post('/account/authenticate',[AccountController::class,'authenticate'])->name('account.authenticate');

Route::get('/account/profile',[AccountController::class,'profile'])->name('account.profile')->middleware('authenticate');
Route::put('/account/update-profile',[AccountController::class,'updateProfile'])->name('account.updateProfile')->middleware('authenticate');

Route::get('/account/logout',[AccountController::class,'logout'])->name('account.logout');

Route::post('/account/update-profile-pic',[AccountController::class,'updateProfilePic'])->name('account.updateProfilePic');

Route::get('/account/create-job',[AccountController::class,'createJob'])->name('account.createJob');

Route::post('/account/save-job',[AccountController::class,'saveJob'])->name('account.saveJob');
Route::get('/account/my-jobs',[AccountController::class,'myJobs'])->name('account.myJobs');