<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\ProfileWebController;
use App\Http\Controllers\Back\ProductController;
use App\Http\Controllers\Back\ProjectController;
use App\Http\Controllers\Back\TeamController;
use App\Http\Controllers\Back\DivisionController;
use App\Http\Controllers\Back\EventController;
use App\Http\Controllers\Back\BannerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('dashboard', DashboardController::class);
Route::resource('profile-web', ProfileWebController::class);
Route::resource('products', ProductController::class);
Route::resource('projects', ProjectController::class);
Route::post('projects/check-project-name', [ProjectController::class, 'checkProjectName'])->name('checkProjectName');
Route::resource('teams', TeamController::class);
Route::resource('divisions', DivisionController::class);
Route::resource('events', EventController::class);
Route::resource('banners', BannerController::class);