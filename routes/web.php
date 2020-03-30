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

Route::get('/itens/', 'FrontController@itens')->name('itens');
Route::get('/ofertas/', 'FrontController@ofertas')->name('ofertas');
Route::get('/checkout/', 'FrontController@checkout')->name('checkout');

Auth::routes();

Route::group(['prefix'=>'admin', 'middleware'=> ['auth','checalojaselecionada']], function (){
    Route::get('/', 'HomeController@index');
    Route::get('dashboard', 'HomeController@dashboard')->name('home.dashboard');
    Route::get('profile', 'HomeController@profile');
    Route::get('cotacoes/enviadas', 'CotacaoController@enviadas')->name('cotacoes.enviadas');
    Route::get('cotacoes/recebidas', 'CotacaoController@recebidas')->name('cotacoes.recebidas');
    Route::get('cotacoes/publicadas', 'CotacaoController@publicadas')->name('cotacoes.publicadas');
    Route::get('cotacoes/{id}/respostas', 'CotacaoController@respostas')->name('cotacoes.respostas');
    Route::post('cotacoes/{id}/publicar', 'CotacaoController@publicar')->name('cotacoes.publicar');
    Route::get('cotacoes/{id}/responder', 'CotacaoController@responder')->name('cotacoes.responder');
    Route::resource('banners', 'BannerController');
    Route::resource('cotacoes', 'CotacaoController');
    Route::resource('campanhas', 'CampanhaController');
    Route::resource('lojas', 'LojaController');
    Route::resource('campanhas.ofertas', 'OfertaController');
    Route::resource('ofertas', 'OfertaController');
    Route::resource('cotacoes.itens', 'ItemController');
    Route::resource('itens', 'ItemController');
    Route::resource('produtos', 'ProdutoController');
    route::resource('tags','TagController');
    route::resource('marcas', 'MarcaController');
    route::resource('tokens', 'TokenController');
    Route::get('/session/setloja/{id}','HomeController@setloja')->name('setLoja');
    Route::resource('categorias', 'CategoriaController');
    Route::resource('enderecos', 'EnderecoController');
});
