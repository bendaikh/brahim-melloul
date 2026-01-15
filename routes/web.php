<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Public Website Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/catalog', [PublicController::class, 'catalog'])->name('catalog');
Route::get('/article/{slug}', [PublicController::class, 'show'])->name('article.show');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Back-Office Routes (Protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Articles
    Route::get('/articles', [AdminController::class, 'articlesIndex'])->name('articles.index');
    Route::get('/articles/create', [AdminController::class, 'articlesCreate'])->name('articles.create');
    Route::post('/articles', [AdminController::class, 'articlesStore'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminController::class, 'articlesEdit'])->name('articles.edit');
    Route::put('/articles/{article}', [AdminController::class, 'articlesUpdate'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminController::class, 'articlesDestroy'])->name('articles.destroy');
    
    // Representants
    Route::get('/representants', [AdminController::class, 'representantsIndex'])->name('representants.index');
    Route::get('/representants/create', [AdminController::class, 'representantsCreate'])->name('representants.create');
    Route::post('/representants', [AdminController::class, 'representantsStore'])->name('representants.store');
    Route::get('/representants/{representant}/edit', [AdminController::class, 'representantsEdit'])->name('representants.edit');
    Route::put('/representants/{representant}', [AdminController::class, 'representantsUpdate'])->name('representants.update');
    Route::delete('/representants/{representant}', [AdminController::class, 'representantsDestroy'])->name('representants.destroy');
    
    // Parametres - Categories
    Route::get('/parametres/categories', [AdminController::class, 'categoriesIndex'])->name('parametres.categories.index');
    Route::get('/parametres/categories/create', [AdminController::class, 'categoriesCreate'])->name('parametres.categories.create');
    Route::post('/parametres/categories', [AdminController::class, 'categoriesStore'])->name('parametres.categories.store');
    Route::get('/parametres/categories/{category}/edit', [AdminController::class, 'categoriesEdit'])->name('parametres.categories.edit');
    Route::put('/parametres/categories/{category}', [AdminController::class, 'categoriesUpdate'])->name('parametres.categories.update');
    Route::delete('/parametres/categories/{category}', [AdminController::class, 'categoriesDestroy'])->name('parametres.categories.destroy');
    
    // Parametres - Car Logos
    Route::get('/parametres/car-logos', [AdminController::class, 'carLogosIndex'])->name('parametres.car-logos.index');
    Route::get('/parametres/car-logos/create', [AdminController::class, 'carLogosCreate'])->name('parametres.car-logos.create');
    Route::post('/parametres/car-logos', [AdminController::class, 'carLogosStore'])->name('parametres.car-logos.store');
    Route::get('/parametres/car-logos/{carLogo}/edit', [AdminController::class, 'carLogosEdit'])->name('parametres.car-logos.edit');
    Route::put('/parametres/car-logos/{carLogo}', [AdminController::class, 'carLogosUpdate'])->name('parametres.car-logos.update');
    Route::delete('/parametres/car-logos/{carLogo}', [AdminController::class, 'carLogosDestroy'])->name('parametres.car-logos.destroy');
});
