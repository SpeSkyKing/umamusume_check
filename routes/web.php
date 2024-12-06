<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmamusumeRegistController;
use App\Http\Controllers\UmamusumelistController;

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
    return view('title');
});

Route::controller(UmamusumeRegistController::class)->name('umamusume_regist.')->group(function(){
    //データ入力画面表示
    Route::get('/umamusume_regist.display','display')->name('display');

    Route::post('/umamusume_regist.regist','regist')->name('regist');

    Route::get('/umamusume_regist.back','back')->name('back');

    Route::get('/umamusume_regist.regist_race','regist_race')->name('regist_race');

    Route::get('/umamusume_regist.regist_race/{race_id}','update_regist_race')->name('update_regist_race');

    Route::post('/umamusume_regist.regist_race_update_data','regist_race_update_data')->name('regist_race_update_data');

    Route::post('/umamusume_regist.regist_race_data','regist_race_data')->name('regist_race_data');

    Route::get('/umamusume_regist.regist_race_display','regist_race_display')->name('regist_race_display');

    Route::get('/umamusume_regist.regist_data_race_check/{id}','regist_data_race_check')->name('regist_data_race_check');

    Route::get('/umamusume_regist.regist_data_race_check/{id}/{season}/{date}/{isfirst}','regist_data_race_check')->name("regist_data_race_check_return");

    Route::get('/umamusume_regist.return_regist_data_race_check/{id}/{season}/{date}/{isfirst}','return_regist_data_race_check')->name("return_regist_data_race_check");

    Route::post('/umamusume_regist.race_data_refresh','race_data_refresh')->name('race_data_refresh');

    Route::get('/umamusume_regist.regist_race_refresh','regist_race_refresh')->name('regist_race_refresh');

});

Route::controller(UmamusumelistController::class)->name('umamusume_list.')->group(function(){
    //データ登録後画面表示
    Route::get('/umamusume_list.display','display')->name('display');

    Route::get('/umamusume_list.regist_data_sort','regist_data_sort')->name('regist_data_sort');

    Route::get('/umamusume_list.back','back')->name('back');
});