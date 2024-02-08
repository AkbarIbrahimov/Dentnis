<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[\App\Http\Controllers\Front\BlogController::class,'index'])->name('front.index');
Route::get('/singlePage/{slug}',[\App\Http\Controllers\Front\BlogController::class,'singlePage'])->name('front.singlePage');
Route::get('/hakkimizda',[\App\Http\Controllers\Front\BlogController::class,'about'])->name('front.about');
Route::get('/headDoctor',[\App\Http\Controllers\Front\BlogController::class,'headDoctor'])->name('front.headDoctor');
Route::get('/contact',[\App\Http\Controllers\Front\BlogController::class,'contact'])->name('front.contact');
Route::post('/contact',[\App\Http\Controllers\Front\BlogController::class,'contactInfo'])->name('front.contactInfo');
Route::get('/makaleler',[\App\Http\Controllers\Front\BlogController::class,'article'])->name('front.article');
Route::get('/tv-programs',[\App\Http\Controllers\Front\BlogController::class,'tvPrograms'])->name('front.tvPrograms');
Route::get('/search',[\App\Http\Controllers\Front\BlogController::class,'search'])->name('front.search');

