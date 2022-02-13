<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;

use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Livewire\Dashboard\Stores\Edit as StoreEditController;

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Livewire\Dashboard\Categories\Index as CategoryIndexController;
use App\Http\Livewire\Dashboard\Categories\Edit as CategoryEditController;

use App\Http\Controllers\Dashboard\EventController;
use App\Http\Livewire\Dashboard\Events\Index as EventIndexController;
use App\Http\Livewire\Dashboard\Events\Edit as EventEditController;

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('',[HomeController::class, 'index'])->name('dashboard.index');

Route::get('/stores/{store}/edit', StoreEditController::class)->middleware('can:dashboard.stores.edit')->name('dashboard.stores.edit');
Route::post('/stores/{store}/files', [StoreController::class, 'files'])->name('dashboard.stores.files');
Route::get('/stores/myStore', [StoreController::class, 'showMyStore'])->middleware('can:dashboard.stores.showMyStore')->name('dashboard.stores.showMyStore');
Route::resource('stores', StoreController::class)->except(['edit'])->names('dashboard.stores');

Route::get('categories', CategoryIndexController::class)->middleware('can:dashboard.categories.index')->name('dashboard.categories.index');
Route::get('/categories/{category}/edit', CategoryEditController::class)->middleware('can:dashboard.categories.edit')->name('dashboard.categories.edit');
Route::post('/categories/{category}/files', [CategoryController::class, 'files'])->name('dashboard.categories.files');
Route::resource('categories', CategoryController::class)->except(['edit','index'])->names('dashboard.categories');

Route::get('events', EventIndexController::class)->middleware('can:dashboard.events.index')->name('dashboard.events.index');
Route::get('/events/{event}/edit', EventEditController::class)->middleware('can:dashboard.events.edit')->name('dashboard.events.edit');
Route::post('/events/{event}/files', [EventController::class, 'files'])->name('dashboard.events.files');
Route::resource('events', EventController::class)->except(['edit','index'])->names('dashboard.events');

Route::post('/users/{user}/logo', [UserController::class, 'logo'])->name('dashboard.users.logo');
Route::resource('users', UserController::class)->names('dashboard.users');
