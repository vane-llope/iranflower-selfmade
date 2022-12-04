<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
//----------------------------------------------------------------------------
//flowers
Route::get('/flowers', [FlowerController::class,'index']);
Route::get('/flowers/{flower}/edit', [FlowerController::class,'edit'])->middleware('auth');
Route::Post('/flowers', [FlowerController::class,'store'])->middleware('auth');
Route::Put('/flowers/{flower}', [FlowerController::class,'update'])->middleware('auth');
Route::delete('/flowers/{flower}', [FlowerController::class,'destroy'])->middleware('auth');
Route::get('/flowers/create', [FlowerController::class,'create'])->middleware('auth');
Route::get('/flowers/manage', [FlowerController::class,'manage'])->middleware('auth');
Route::get('/flowers/{flower}', [FlowerController::class,'show']);
//----------------------------------------------------------------------------
//products
Route::get('/products',[ ProductController::class,'index']);
Route::get('/products/shops',[ ProductController::class,'shops']);
Route::get('/products/shops/{user}',[ ProductController::class,'shop']);
Route::get('/products/{product}/edit',[ ProductController::class,'edit'])->middleware('auth');
Route::Post('/products', [ProductController::class,'store'])->middleware('auth');
Route::Put('/products/{product}', [ProductController::class,'update'])->middleware('auth');
Route::delete('/products/{product}', [ProductController::class,'destroy'])->middleware('auth');
Route::get('/products/create', [ProductController::class,'create'])->middleware('auth');
Route::get('/products/manage',[ ProductController::class,'manage'])->middleware('auth');
Route::get('/products/manage/all',[ ProductController::class,'manageAll'])->middleware('auth');
Route::get('/products/{product}', [ProductController::class,'show']);
//----------------------------------------------------------------------------
//users
Route::get('/users/manage',[ UserController::class,'index'])->middleware('auth');
Route::get('/users/change-password', [UserController::class, 'changePassword'])->name('change-password')->middleware('auth');
Route::post('/users/change-password', [UserController::class, 'updatePassword'])->name('update-password')->middleware('auth');
Route::post('/users/logout',[UserController::class,'logout'])->middleware('auth');
Route::get('/users/login',[UserController::class,'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate',[UserController::class,'authenticate']);
Route::post('/users',[ UserController::class,'store']);
Route::get('/users/{user}/edit',[ UserController::class,'edit'])->middleware('auth');
Route::Put('/users/{user}',[ UserController::class,'update'])->middleware('auth');
Route::delete('/users/{user}',[ UserController::class,'destroy'])->middleware('auth');
Route::get('/users/register',[ UserController::class,'create'])->middleware('guest');
Route::get('/users/{user}', [UserController::class,'show'])->middleware('auth');
//----------------------------------------------------------------------------
//article
Route::get('/articles/manage',[ ArticleController::class,'manage'])->middleware('auth');
Route::Post('/articles', [ArticleController::class,'store'])->middleware('auth');
Route::Put('/articles/{article}', [ArticleController::class,'update'])->middleware('auth');
Route::get('/articles/{article}/edit',[ ArticleController::class,'edit'])->middleware('auth');
Route::get('/articles/create', [ArticleController::class,'create'])->middleware('auth');
Route::get('/articles/{article}', [ArticleController::class,'show']);
Route::delete('/articles/{article}', [ArticleController::class,'destroy'])->middleware('auth');
//----------------------------------------------------------------------------
//roles
Route::get('/roles/manage',[ RoleController::class,'index'])->middleware('auth');
Route::Post('/roles', [RoleController::class,'store'])->middleware('auth');
Route::Put('/roles/{role}', [RoleController::class,'update'])->middleware('auth');
Route::get('/roles/{role}/edit',[ RoleController::class,'edit'])->middleware('auth');
Route::get('/roles/create', [RoleController::class,'create'])->middleware('auth');
Route::get('/roles/{role}', [RoleController::class,'show'])->middleware('auth');
Route::delete('/roles/{role}', [RoleController::class,'destroy']);

/*
//flowers
Route::get('/flowers/manage', [FlowerController::class,'manage']);
Route::resource('/flowers',FlowerController::class);
//products
Route::get('/products/manage', [ProductController::class,'manage']);
Route::resource('/products',ProductController::class);
//users
Route::get('/users/manage', [UserController::class,'manage']);
Route::resource('/users',UserController::class);
*/