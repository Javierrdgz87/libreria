<?php

// DB::listen(function($query){
//     echo "<pre>{$query->sql}</pre>";
// 	echo "<pre>{$query->time}</pre>";
// });

Route::get('/',   ['uses' => 'web\Sist\HomeController@index']);

Route::resource('categorias', 'web\Cata\CatCategoriaController', ['except' => ['destroy']]);
Route::get('categorias/{id}/delete', ['as' => 'categorias.destroy', 'uses' => 'web\Cata\CatCategoriaController@destroy']);

Route::resource('libros', 'web\Cata\CatLibroController', ['except' => ['destroy']]);
Route::get('libros/{id}/delete', ['as' => 'libros.destroy', 'uses' => 'web\Cata\CatLibroController@destroy']);
Route::post('libros/{id}', ['as' => 'libros.saveBorrow', 'uses' => 'web\Cata\CatLibroController@saveBorrow']);
// autocomplete
Route::get('autoCategoria',['uses'=>'web\Cata\CatCategoriaController@autoCategoria'])->name('autoCategoria');
