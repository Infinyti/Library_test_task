<?php

Route::get('/', function () {
    return view('home');
})->name('home');


Route::resource('books', 'BooksController');

Route::resource('authors', 'AuthorController');
