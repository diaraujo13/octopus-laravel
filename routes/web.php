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

Route::get('/', function () {
    $items = \App\Imovel::all()->take(5);
    $info = \App\Configurations::all();

    return view('front.list')->with([
        'items' => $items,
        'info' => array_pluck($info->toArray(), 'value', 'key')
    ]);
});

Route::prefix('admin')->group(function(){
    Route::get('/', '\App\Http\Controllers\Auth\LoginController@showLoginForm');
    Auth::routes();
});

Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');


    /** Cadastro e gerenciamento de imóveis */
    Route::get('imovel', 'ImovelController@index')->name('imovel.index');
    Route::get('imovel/create', 'ImovelController@create')->name('imovel.create');
    Route::post('imovel', 'ImovelController@store')->name('imovel.store');
    Route::get('imovel/{imovel}/edit', 'ImovelController@edit')->name('imovel.edit');
    Route::put('imovel/{imovel}', 'ImovelController@update')->name('imovel.update');
    Route::delete('imovel/{imovel}', 'ImovelController@destroy')->name('imovel.destroy');
    
    /** Gerenciamento dos anúncios */

    /** Configurações gerais do site */
    Route::get('/config', 'ConfigurationsController@index')->name('config');
    Route::post('/config', 'ConfigurationsController@store')->name('config.store');
    
});


