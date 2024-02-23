<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CellarsController;
use App\Http\Controllers\CellarController;
use App\Models\Cellars;
use App\Http\Controllers\Saq_wineController;
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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/scraper', [ScraperController::class, 'scraper'])->name('scraper.index');

    Route::patch('/cellars/{cellar}', [CellarsController::class, 'update'])->name('cellars.update');
    Route::get('/cellars', [CellarsController::class, 'userCellars'])->name('cellars.userCellars');
    Route::get('/cellars/{id}', [CellarsController::class, 'userCellarContents'])->name('cellars.userCellarContent');
    Route::get('/cellars-search/{search}', [CellarsController::class, 'searchWineInUserCellars'])->name('cellars.searchWineInUserCellars');
    Route::get('/wines-saq', [CellarsController::class, 'winesSaq'])->name('cellars.winesSaq');

    Route::get('/saq-wines', [Saq_wineController::class, 'index'])->name('saq-wines.index');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard')->middleware('verified');

    Route::get('/add-wine-cellar', function () {
        return Inertia::render('AddWineToCellar');
        })->name('addWineToCellar')->middleware('verified');

    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard')->middleware('verified');
});

require __DIR__.'/auth.php';
