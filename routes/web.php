<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceCategoryController;

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
    return view('web.layout.layout');
});

Route::get('/posts/show-api', [PostController::class, 'showApi'])->name('posts.show.api');

Route::resource('posts', PostController::class);

Route::get('/books', [BookController::class, 'index'])->name('books.index');
// Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/books/show-api', [BookController::class, 'showApi'])->name('books.show.api');

Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
Route::get('/brands/show-api', [BrandController::class, 'showApi'])->name('brands.show.api');

Route::get('/sc', [ServiceCategoryController::class, 'index'])->name('sc.index');
Route::get('/sc/create', [ServiceCategoryController::class, 'create'])->name('sc.create');
Route::get('/sc/{sc}/edit', [ServiceCategoryController::class, 'edit'])->name('sc.edit');
Route::post('/sc', [ServiceCategoryController::class, 'store'])->name('sc.store');
Route::put('/sc/{sc}', [ServiceCategoryController::class, 'update'])->name('sc.update');
Route::delete('/sc/{sc}', [ServiceCategoryController::class, 'destroy'])->name('sc.destroy');
Route::get('/sc/show-api', [ServiceCategoryController::class, 'showApi'])->name('sc.show.api');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::get('/employees/show-api', [EmployeeController::class, 'showApi'])->name('employees.show.api');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('/customers/show-api', [CustomerController::class, 'showApi'])->name('customers.show.api');



//Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit')->middleware('auth', 'throttle:5,1');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
