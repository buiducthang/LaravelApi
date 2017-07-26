<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/comment',[
    'uses' => 'CommentController@createComment'
]);

Route::get('/comments',[
    'uses' => 'CommentController@getComments'
]);

Route::put('/comment/{id}',[
    'uses' => 'CommentController@updateComment'
]);

Route::delete('/comment/{id}',[
    'uses' => 'CommentController@deleteComment'
]);
