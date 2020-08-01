<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

// Rotas de contato
Route::get('contact-us',array('as'=>'contato','uses'=>'PageController@getContact'));
Route::post('contact-us',array('as'=>'postcontact','uses'=>'PageController@postContact'));

// Código pra testar autenticação em métodos. Qualquer Route:: colocado aqui dentro, só funcionará se o usuário
// estiver logado.
Route::middleware(['auth'])->group(function () {
    // Rotas das comidas
    Route::get('/comidas', 'ComidaController@index')->name('comida');
    Route::post('/comidas/adicionarAoCarrinho', 'CarrinhoController@adicionarAoCarrinho');
    Route::post('/comidas/retirarComida', 'CarrinhoController@retirarComida');
    // Rotas do carrinho
    Route::get('/carrinho', 'CarrinhoController@verCarrinho')->name('carrinho');
    Route::post('/carrinho/encomendar', 'CarrinhoController@encomendar')->name('carrinho_encomendar');
    // Rotas da reserva
    Route::get('/reserva', 'ReservaController@index')->name('reserva');
    Route::post('store', 'ReservaController@store')->name('store');

    // Essas rotas são apenas para a adição de comidas
    Route::get('/comidas/create', 'ComidaController@create')->name('comida_create');
    Route::post('/comidas/create/store', 'ComidaController@store')->name('comida_store');

    // Rotas para o caso de o restaurante estar fechado
    Route::get('/fechado', function () {
        return view('fechado');
    })->name('fechado');
});
