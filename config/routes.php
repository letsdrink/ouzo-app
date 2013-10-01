<?php
use Ouzo\Routing\Route;
Route::get('/', 'users#index');
Route::allowAll('/hello_world', 'hello_world');
Route::resource('users');