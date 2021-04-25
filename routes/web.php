<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/','inicio');


//Creados por El Desarrollador
Route::get('inicio','Web\pageController@inicio')->name('inicio');
Route::get('estadios','Web\pageController@stadiums')->name('stadiums'); //estadios en web
Route::get('estadio/{slug}','Web\pageController@stadium')->name('stadium'); //detalle estadio en web
Route::get('equipos','Web\pageController@teams')->name('teams'); //equipos en web
Route::get('equipo/{slug}','Web\pageController@team')->name('team'); //detalle de equipo en web
Route::get('ligas','Web\pageController@competitions')->name('competitions'); //ligas en web
Route::get('liga/{slug}','Web\pageController@competition')->name('competition'); //detalle de liga en web
Route::get('destroy','Web\pageController@sessionDestroy')->name('sessionDestroy');
//cambio de informacion del usuario
Route::get('/cambiar-contrasena/',function () {
    return view('session.mypassword');
})->middleware(['auth'])->name('mypassword');
Route::get('/cambiar-datos/',function () {
    return view('session.myinfo');
})->middleware(['auth'])->name('myinfo');
Route::post('/dashboard','Web\pageController@savemyinfo')->name('savemyinfo');


//rutas de seguridad
Route::resource('users','Seg\userController');
Route::resource('options','Seg\optionController');
Route::resource('profiles','Seg\profileController');
Route::resource('modules','Seg\moduleController');
//rutas de sportfans
Route::resource('stadiums','Sportfans\stadiumController');
Route::resource('regions','Sportfans\regionController');
Route::resource('sports','Sportfans\sportController');
Route::resource('teams','Sportfans\teamController');
Route::resource('competitions','Sportfans\competitionController');
Route::resource('seasons','Sportfans\seasonController');

Route::get('useraccess/{module}','Seg\moduleController@useraccess')->name('useraccess');
Route::post('access','Seg\moduleController@saveaccess')->name('saveaccess');
Route::get('qualification/{season}','Sportfans\seasonController@qualification')->name('qualification');
Route::post('qualification','Sportfans\seasonController@saveQualification')->name('saveQual');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

