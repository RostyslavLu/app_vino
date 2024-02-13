<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CellarsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/scraper', [ScraperController::class, 'scraper'])->name('scraper.index');
    Route::get('/search', [SearchController::class, 'search'])->name('search.index');
    Route::get('/cellars', [CellarsController::class, 'userCellars'])->name('cellars.userCellars');
    Route::get('/cellars/{id}', [CellarsController::class, 'userCellarContents'])->name('cellars.userCellarContent');
    Route::get('/cellars-search/{search}', [CellarsController::class, 'searchWineInUserCellars'])->name('cellars.searchWineInUserCellars');
});

require __DIR__.'/auth.php';
