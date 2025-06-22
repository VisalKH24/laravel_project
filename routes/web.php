<?php

use App\Http\Controllers\BackendController\CategoryController;
use App\Http\Controllers\BackendController\LogoController;
use App\Http\Controllers\BackendController\NewsController;
use App\Http\Controllers\BackendController\ProductController;
use App\Http\Controllers\BackendController\UserController;
use App\Http\Controllers\FrontController\ProductController as FrontControllerProductController;
use App\Http\Controllers\FrontController\ShopController;
use App\Models\Category;
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



// Route::get('/news', function () {
//     return view('Frontend.news');
// });
Route::controller(FrontControllerProductController::class)->group(function(){
   Route::get('/','home')->name('getall');
   Route::get('/shop','shop')->name('shop');
   Route::get('/news','getAllNews')->name('news');
//    Route::get('/get-news','getAllNews')->name('get-news');
   Route::get('/news-detail/{news}','newDetail')->name('news-detail');
   Route::get('/search-product','searchProduct')->name('searchProduct');
    Route::get('/product/{product}','product')->name('product');
    Route::get('/buy-product/{product}','buyProduct')->name('buy-product');
    Route::post('/buy-product-submit/{product}','buyProductSubmit')->name('buy-product-submit');


});


Route::controller(UserController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::get('/register','register')->name('register');
    Route::post('/signup-submit','signupSubmit')->name('signupSubmit');
    Route::post('/loginSubmit','loginSubmit')->name('loginSubmit');
    Route::get('/logout','logout')->name('logout');
    Route::get('/admin/edit-profile/{user}','editProfile')->name('editProfile');
    Route::post('/admin/edit-profile-submit{user}','editProfileSubmit')->name('editProfileSubmit');
});
Route::get('/admin/dashboard', [UserController::class, 'dashBoard'])
    ->middleware('auth')
    ->name('dashBoard');
Route::middleware(['auth'])->group(function(){
    Route::get('/admin',function(){
        return view('backend.master');
    });
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/add-product','addProduct')->name('addProduct');
        Route::post('/admin/add-product-submit','addProductSubmit')->name('addProductSubmit');
        Route::get('/admin/list-product','listProduct');
        Route::post('/admin/delete-product','deleteProduct')->name('deleteProduct');
        Route::get('/admin/edit-product/{product}','editProduct')->name('editProduct');
    });
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/add-category','addCategory')->name('addCategory');
        Route::post('/admin/add-category-submit','addCateSubmit')->name('addCateSubmit');
        Route::get('/admin/list-category','viewCate')->name('viewCate');
        Route::get('/admin/edit-category/{category}','editCate')->name('editCategory');
        Route::post('/admin/delete-category','deleteCate')->name('deleteCate');
    });
    Route::controller(LogoController::class)->group(function(){
        Route::get('/admin/add-logo','addLogo')->name('addLogo');
        Route::get('/admin/list-logo','listLogo')->name('listLogo');
        Route::post('/admin/add-logoSubmit','addLogoSubmit')->name('addLogoSubmit');
        Route::get('/admin/edit-logo/{logo}','editLogo')->name('editLogo');
        // Route::post('/admin/edit-logoSubmit','editLogoSubmit')->name('editLogoSubmit');
        Route::post('/delete-logo','deleteLogo')->name('deleteLogo');

    });
    Route::controller(NewsController::class)->group(function(){
        Route::get('/admin/add-news','addNews')->name('addNews');        
        Route::get('/admin/list-news','listNews')->name('listNews');
        Route::post('/admin/add-news-submit','addNewsSubmit')->name('addNews-Submit');
        Route::get('/admin/edit-news/{news}','editNews')->name('editNews');
        Route::post('/admin/delete-news','deleteNews')->name('deleteNews');
    });
});
