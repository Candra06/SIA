<?php

use Illuminate\Support\Facades\Auth;
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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/access/block', 'BlockController@index');
Route::get('/',  function ()
{
    return redirect('/login');
});
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/homes/index', 'Dashboard\HomeController@index');
    Route::delete('/homes/index/{id}', 'Dashboard\HomeController@delete');
    Route::get('/settings/profile/', 'Dashboard\SettingController@profile');
    Route::put('/settings/profile/{id}', 'Dashboard\SettingController@updateprofile');
    Route::get('/settings/password/', 'Dashboard\SettingController@password');
    Route::put('/settings/password/{id}', 'Dashboard\SettingController@updatepassword');
    Route::resource('/settings/general', 'Dashboard\GeneralController');
    Route::resource('/managements/menu', 'Dashboard\MenuController');
    Route::resource('/managements/submenu', 'Dashboard\SubmenuController');
    Route::resource('/managements/role', 'Dashboard\RolemenuController');
    Route::resource('/users/index', 'Dashboard\UserController');
    Route::resource('/akun/data', 'Dashboard\AkunController');
    Route::resource('/jurnal/data', 'Dashboard\JurnalController');
    Route::resource('/bukubesar/data', 'Dashboard\BukubesarController');
    Route::resource('/neraca/data', 'Dashboard\NeracaController');
    Route::resource('/laporan/data', 'Dashboard\LaporanController');
});
