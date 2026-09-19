<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes — KPM Group Company Profile
|--------------------------------------------------------------------------
*/

Route::get('/',         [HomeController::class,     'index'])->name('home');
Route::get('/about',    [AboutController::class,    'index'])->name('about');
Route::get('/about/dokumentasi/{division}', [AboutController::class, 'documentation'])->name('about.documentation');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/contact',  [ContactController::class,  'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
