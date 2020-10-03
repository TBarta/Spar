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

Route::get('/', "UserController@index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//USER CONTROLLER

Route::get("user/{id}/profile_picture", "UserController@profile_pic");
Route::resource('user', 'UserController');

//MESSAGE CONTROLLER

Route::get('/messages/sent', 'MessageController@sent');
Route::resource("/messages", "MessageController");
Route::get("messages/{id}/create", "MessageController@create");
Route::get("messages/{id}/respond", "MessageController@respond");
Route::post("messages/{id}/respond", "MessageController@respond_store");


//Route::resource('user/{id}/message', 'MessageController')->except('create');

//NOTICE CONTROLLER

Route::resource('notice', 'NoticeController');

//SEARCH CONTROLLER
Route::post('search/simple', 'SearchController@store_simple');
Route::get('search/simple', 'SearchController@show_simple');
Route::resource('search', 'SearchController');



//GROUPS
Route::get("groups/{group}/join", "GroupController@join");

Route::post("groups/{group}/leave", "GroupController@leave");

Route::resource("groups", "GroupController");


// ADMINISTRATION

Route::get("groups/{group}/wannajoin", "GroupAdministrationController@joinrequest");

Route::post("groups/{group}/joincancel", "GroupAdministrationController@cancelrequest");

Route::post("groups/{group}/kick/{user}", "GroupAdministrationController@kick");

Route::post("groups/{group}/{user}/decline", "GroupAdministrationController@declinerequest");

Route::post("groups/{group}/{user}/accept", "GroupAdministrationController@acceptrequest");

Route::get("groups/{group}/upload_picture", "GroupAdministrationController@createpicture");

Route::post("groups/{group}/upload_picture", "GroupAdministrationController@storepicture");


// ARTICLES

Route::post("groups/{group}/articles/{id}/update", "GroupArticlesController@update");

Route::post("groups/{group}/articles/{id}", "GroupArticlesController@destroy");

Route::get("groups/{group}/articles/{id}", "GroupArticlesController@edit");

Route::post("groups/{group}/articles", "GroupArticlesController@store");

//PHOTOS
Route::resource("/groups/{group}/photos", "PhotosController");

// TRAINERS
Route::post("trainers/{id}/goback", "TrainerController@goback");
Route::get("trainers/dashboard", "TrainerController@dashboard");
Route::resource("trainers", "TrainerController");

// FRIENDS

Route::post("friends/{id}/add", "FriendsController@addfriend");
Route::post("friends/{id}/cancel", "FriendsController@cancel");
Route::post("friends/{id}/accept", "FriendsController@accept");
Route::post("friends/{id}/deny", "FriendsController@deny");
Route::post("friends/{id}/delete", "FriendsController@delete");


