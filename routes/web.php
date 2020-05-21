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

Route::get('/', 'FrontController@index')
    ->name('index');
Route::get('/busca', 'FrontController@busca')
    ->name('busca');
Route::get('/itens', 'FrontController@itens')
    ->name('itens');
Route::get('/ofertas', 'FrontController@ofertas')
    ->name('ofertas');

Route::group(['middleware' => 'auth'], function(){
    Route::post('/pedido', 'FrontController@pedido')
        ->name('pedido');
    Route::post('/cotacao', 'FrontController@cotacao')
        ->name('cotacao');
    Route::get('/checkout', 'FrontController@checkout')
        ->name('checkout');
    Route::resource('lojas', 'LojaController');
    Route::get('/admin/session/setloja/{id}','HomeController@setloja')
        ->name('setLoja');
});

Route::get('layout', 'FrontController@layout');

Auth::routes();

Route::group(['prefix'=>'admin', 'middleware'=> ['auth']], function (){
    Route::get('/', 'HomeController@index');
    Route::get('dashboard', 'HomeController@dashboard')
        ->name('home.dashboard');
    Route::get('profile', 'HomeController@profile');
    Route::resource('banners', 'BannerController');
    Route::resource('campanhas', 'CampanhaController');
    Route::resource('campanhas.ofertas', 'OfertaController');
    Route::resource('categorias', 'CategoriaController');

    Route::get('cotacoes/enviadas', 'CotacaoController@enviadas')
        ->name('cotacoes.enviadas');
    Route::get('cotacoes/publicadas', 'CotacaoController@publicadas')
        ->name('cotacoes.publicadas');
    Route::post('cotacoes/{id}/publicar', 'CotacaoController@publicar')
        ->name('cotacoes.publicar');
    Route::get('cotacoes/recebidas', 'CotacaoController@recebidas')
        ->name('cotacoes.recebidas');
    Route::get('cotacoes/{id}/respostas', 'CotacaoController@respostas')
        ->name('cotacoes.respostas');
    Route::get('cotacoes/{id}/responder', 'CotacaoController@responder')
        ->name('cotacoes.responder');
    Route::resource('cotacoes.itens', 'ItemController');
    Route::resource('cotacoes', 'CotacaoController');
    Route::resource('enderecos', 'EnderecoController');
    Route::resource('itens', 'ItemController');
    Route::resource('marcas', 'MarcaController');
    Route::resource('ofertas', 'OfertaController');
    Route::resource('pedidos', 'PedidoController');
    Route::get('pedidos/{id}/print', 'PedidoController@print')
        ->name('pedidos.print');
    Route::get('produtos/importar', 'ProdutoController@importar')
        ->name('produtos.importar');
    Route::resource('produtos', 'ProdutoController');
    Route::resource('tags','TagController');
    Route::resource('tokens', 'TokenController');
});