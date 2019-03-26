<?php
use App\Comment;
use App\CommentReply;
use App\User;
use App\Role;
use App\Photo;
use App\Post;
use App\Category;

use App\UsersRequest;
use App\Http\Controllers\AdminMediaController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CommentRepliesController;

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

Route::get('/', function (){
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function(){

    return view('admin.index');

});

Route::get('admin/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::group(['middleware' => 'admin'], function(){

    Route::get('/admin', function(){

        return view('admin.index');
    
    });

    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/media', 'AdminMediaController');
    //Route::get('admin/media/upload', ['as'=>'admin.media.upload', 'uses'=>'AdminMediaController@store']);
    Route::resource('admin/comments/replies', 'CommentRepliesController');
    Route::resource('admin/comments', 'CommentController');



});






//Route::get('admin/users/create', 'AdminUsersController@create');


