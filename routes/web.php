<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\AfiliationCompany;


use App\Mail\StoreRegisterMailable;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', function () { return view('principal'); })->name('principal');

Route::get('/directory', [CategoryController::class, 'home'])->name('directory');

Route::get('search', SearchController::class)->name('search');

Route::get('/about', function () { return view('about'); })->name('about');

Route::post('/afiliate/files', [AfiliationCompany::class, 'addTemporaryImages'])->name('companies.files');
Route::get('/afiliate', [CompanyController::class, 'create'])->name('companies.create');

Route::get('/events', [EventController::class, 'index'])->name('events');

Route::get('/contact', function () { return view('contact'); })->name('contact');

// CIUDADES
Route::get('/municipios/{municipio?}', [CityController::class, 'showBySlug'])->name('cities.showBySlug');

// CATEGORIAS
Route::get('/categories/{category?}/stores', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category?}', [CategoryController::class, 'redirect'])->name('categories.redirect');

// NEGOCIOS
Route::get('/categories/{category?}/stores/{company?}', [CompanyController::class, 'show'])->name('companies.show');


Route::get('email', function () {

    $store = Company::find(1);
    $key = '123';
    $correo = new StoreRegisterMailable($store, $key);
    Mail::to('orozco.ksg@gmail.com')->send($correo);

    return 'mensaje enviado';
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
