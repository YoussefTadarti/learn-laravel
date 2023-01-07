<?php

use App\Http\Controllers\AjaxOfferController;
use App\Http\Controllers\Auth\customAuthController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\YoutubeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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
    // return 'You cant access to this page';
    return view('welcome');
})->name('not.welcome');


Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/landing',function (){
    return view('landing');
});
Route::resource('/news', NewsController::class);
Route::namespace('Front')->group(function (){
    Route::get('/welcome',[UserController::class,'welcome']);
});
Route::group([ 'prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::group(['prefix'=> 'offers'],function (){
        Route::get('/create',[OfferController::class,'create']);
        Route::post('/store',[OfferController::class,'store'])->name('offers.store');
        Route::get('/index',[OfferController::class,'index'])->name('offers.index');
        Route::get('/edit/{id}',[OfferController::class,'edit'])->name('offers.edit');
        Route::post('/update/{id}',[OfferController::class,'update'])->name('offers.update');
        Route::get('/delete/{id}',[OfferController::class,'destroy'])->name('offers.destroy');

    });

});
############################################## Begin Ajax Routes ######################################################

Route::group(['prefix'=> 'ajax-offers'],function () {
    Route::get("create", [AjaxOfferController::class, "create"])->name('ajax-offers.create');
    Route::post("store", [AjaxOfferController::class, "store"])->name('ajax-offers.store');
    Route::get("index", [AjaxOfferController::class, "index"])->name('ajax-offers.index');
    Route::get('edit/{id}',[AjaxOfferController::class,'edit'])->name('ajax-offers.edit');
    Route::post('update',[AjaxOfferController::class,'update'])->name('ajax-offers.update');
    Route::post("delete", [AjaxOfferController::class, "delete"])->name('ajax-offers.delete');

});
############################################## End Ajax Routes ########################################################
############################################## Begin Authentication & Guards ########################################################
Route::group(['namespace'=>'Auth','middleware'=>'checkAge'],function(){
    Route::get('adults',[customAuthController::class,'index'])->name('adult.index');
});
Route::group(['namespace'=>'Auth'],function(){
    Route::get('site',[customAuthController::class,'indexSite'])->name('site.index')->middleware('auth:web');
    Route::get('admin',[customAuthController::class,'indexAdmin'])->name('admin.indexAdmin')->middleware('auth:admin');
    Route::get('admin/login',[customAuthController::class,'loginPage'])->name('loginPage');
    Route::post('admin/lol',[customAuthController::class,'checkAdmin'])->name('admin.checkAdmin');

});
############################################## End Authentication & Guards ########################################################


