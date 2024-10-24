<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Backend\AdminController;
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
Route::group(['prefix'=>'/admin','middleware'=>['auth']],function(){
    Route::get('/',[\App\Http\Controllers\Backend\AdminController::class,'index'])->name('admin');
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    // user route
    Route::resource('users','\App\Http\Controllers\Backend\UsersController');
    // Banner
    Route::resource('banner','App\Http\Controllers\Backend\BannerController');
    // Brand
    Route::resource('brand','\App\Http\Controllers\Backend\BrandController');
    // Profile
    Route::get('/profile','\App\Http\Controllers\Backend\AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','\App\Http\Controllers\Backend\AdminController@profileUpdate')->name('profile-update');
    // Category
    Route::resource('/category','\App\Http\Controllers\Backend\CategoryController');
    // Product
    Route::resource('/product','\App\Http\Controllers\Backend\ProductController');
    // Ajax for sub category
    Route::post('/category/{id}/child','CategoryController@getChildByParent');
    // POST category
    Route::resource('/post-category','\App\Http\Controllers\Backend\PostCategoryController');
    // Post tag
    Route::resource('/post-tag','\App\Http\Controllers\Backend\PostTagController');
    // Post
    Route::resource('/post','\App\Http\Controllers\Backend\PostController');
    // Message
    Route::resource('/message','\App\Http\Controllers\Backend\MessageController');
    Route::get('/message/five','\App\Http\Controllers\Backend\MessageController@messageFive')->name('messages.five');

    // Order
    Route::resource('/order','\App\Http\Controllers\Backend\OrderController');
    // Shipping
    Route::resource('/shipping','\App\Http\Controllers\Backend\ShippingController');
    // Coupon
    Route::resource('/coupon','\App\Http\Controllers\Backend\CouponController');
    // Settings
    Route::get('settings','\App\Http\Controllers\Backend\AdminController@settings')->name('settings');
    Route::post('setting/update','\App\Http\Controllers\Backend\AdminController@settingsUpdate')->name('settings.update');

    // Notification
    Route::get('/notification/{id}','\App\Http\Controllers\Backend\NotificationController@show')->name('admin.notification');
    Route::get('/notifications','\App\Http\Controllers\Backend\NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','\App\Http\Controllers\Backend\NotificationController@delete')->name('notification.delete');
    // Password Change
    Route::get('change-password', '\App\Http\Controllers\Backend\AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', '\App\Http\Controllers\Backend\AdminController@changPasswordStore')->name('change.password');
    // Post Comment
    Route::post('post/{slug}/comment','\App\Http\Controllers\Backend\PostCommentController@store')->name('post-comment.store');
    Route::resource('/comment','\App\Http\Controllers\Backend\PostCommentController');
});
