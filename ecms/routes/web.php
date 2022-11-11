<?php

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


use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\UserController;


//Route::get('/', function () {
//    return view('welcome');
//});


Route::namespace('Frontend')->group(function () {
    Route::get('/',[\App\Http\Controllers\Frontend\DefaultController::class,'index'])->name('home.index');

    //Blog
    Route::get('/blog',[\App\Http\Controllers\Frontend\BlogController::class,'index'])->name('blog.Index');
    Route::get('/blog/{slug}',[\App\Http\Controllers\Frontend\BlogController::class,'detail'])->name('blog.Detail');
    //Page
    Route::get('/page/{slug}',[\App\Http\Controllers\Frontend\PageController::class,'detail'])->name('page.Detail');

    //Contact
    Route::get('/contact',[\App\Http\Controllers\Frontend\DefaultController::class,'contact'])->name('contact.Detail');
    Route::post('/contact',[\App\Http\Controllers\Frontend\DefaultController::class,'sendMail']);

});

Route::namespace('Backend')->group(function () {
    Route::prefix('nedmin')->group(function () {
        Route::get('/dashboard', [DefaultController::class, 'index'])->name('nedmin.Index')->middleware('admin');
        Route::get('/', [DefaultController::class,'login'])->name('nedmin.Login')->middleware('CheckLogin');
        Route::get('/login', [DefaultController::class, 'logout'])->name('nedmin.Logout');
        Route::post('/login', [DefaultController::class, 'authenticate'])->name('nedmin.Authenticate');
    });

    Route::middleware(['admin'])->group(function () {
        Route::prefix('nedmin/settings')->group(function () {
            Route::get('/', [SettingsController::class, 'index'])->name('settings.Index');
            Route::post('', [SettingsController::class, 'sortable'])->name('settings.Sortable');
            Route::get('/delete/{id}', [SettingsController::class, 'destroy']);
            Route::get('/edit/{id}', [SettingsController::class, 'edit'])->name('settings.Edit');
            Route::post('/{id}', [SettingsController::class, 'uptade'])->name('settings.Uptade');
        });
    });
});

Route::prefix('nedmin')->group(function () {

    Route::middleware(['admin'])->group(function () {
        //Blog
        Route::post('/blog/sortable', [BlogController::class, 'sortable'])->name('blog.Sortable');
        Route::resource('blog', BlogController::class);
        //Page
        Route::post('/pages/sortable', [PageController::class, 'sortable'])->name('page.Sortable');
        Route::resource('page', PageController::class);
        //Sliders
        Route::post('/slider/sortable', [SliderController::class, 'sortable'])->name('slider.Sortable');
        Route::resource('slider', SliderController::class);
        //Admin
        Route::post('/user/sortable', [UserController::class, 'sortable'])->name('user.Sortable');
        Route::resource('user', UserController::class);

    });

});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
