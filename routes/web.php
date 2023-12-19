<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Admin\DashboardController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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


    //Posts (For login users)
    Route::resource('posts', PostController::class);

    Route::get('/',[AuthController::class,'index'])->name('getIndex');


    //Blog (for public user)
    Route::get('blog/{slug}',[BlogController::class,'single'])->where('slug','[\w\d\-\_]+')->name('blog.singer');
    Route::get('blog',[BlogController::class,'index'])->name('blog.index');
    Route::post('/search', [BlogController::class,"search"])->name("blog.search");
    Route::get('/category/{category_id}', [BlogController::class,'categorySearch'])->name("blog.category");

    //Pages
    Route::get('/', [PagesController::class,"index"])->name("public.index");

    //Comments (form blog controller)
    Route::post('store_comment',[BlogController::class,"storeComment"])->name('comments.store');
    Route::post('delete_comment/{id}',[BlogController::class,"deleteComment"])->name('comments.delete');

    //  Categories
    Route::resource('categories',CategoryController::class)->except(['create']);

    // Tags
    Route::resource('tags',TagController::class);

    //Authentication routes
    Auth::routes();

    //admin route
    Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
        Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.index');
    });
