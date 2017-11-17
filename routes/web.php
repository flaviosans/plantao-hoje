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

Route::get('/', 'FrontController@index')->name('index');
Route::get('/busca', 'FrontController@busca')->name('busca');

Route::get('/ofertas/', 'FrontController@ofertas')->name('ofertas');

Auth::routes();

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function (){
    Route::get('/', 'HomeController@index');
    Route::get('dashboard', 'HomeController@dashboard')->name('home.dashboard');
    Route::get('profile', 'HomeController@profile');
    Route::resource('banners', 'BannerController');
    Route::resource('campanhas', 'CampanhaController');
    Route::resource('lojas', 'LojaController');
    Route::resource('campanhas.ofertas', 'OfertaController');
    Route::resource('ofertas', 'OfertaController');
    Route::resource('produtos', 'ProdutoController');
    route::resource('tags','TagController');
    route::resource('marcas', 'MarcaController');
    route::resource('tokens', 'TokenController');
    Route::get('/session/setloja/{id}','HomeController@setloja')->name('setLoja');
    Route::resource('categorias', 'CategoriaController');
    Route::get('/teste/{barras}'  , 'HomeController@teste');

});
