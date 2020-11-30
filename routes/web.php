<?php

use Illuminate\Support\Facades\Route;
use App\Movie;
use App\User;
use App\Cast;
use App\Comment;

//------------------------ROUTES FOR AUTH------------------------------\\
Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
//----------------------------------------------------------------------\\


//------------------------ROUTES FOR USER------------------------------\\
Route::get('/users', 'UserController@index');
Route::get('/users/ban/{user}', 'UserController@ban');
Route::get('/sortUsers', 'UserController@sortUsers');
Route::get('/users/create', 'UserController@create');
Route::get('/users/{user}', 'UserController@show');
Route::get('/users/{user}/edit', 'UserController@edit');
Route::post('/updateDetails/{user}', 'UserController@updateUserDetails');
Route::post('/privateProfile/{user}/{privacy}', 'UserController@privateProfile');
Route::post('/updatePassword/{user}', 'UserController@updatePassword');
Route::post('/uploadImage/{user}', 'UserController@uploadImage');
Route::get('/users/delete/{user}', 'UserController@destroy');
//----------------------------------------------------------------------\\

//------------------------ROUTES FOR MOVIE------------------------------\\
Route::get('/movies', 'MovieController@index');
Route::get('/getMovies', 'MovieController@getMovies');
Route::post('/addMovie', 'MovieController@store');
Route::get('/newMovie', 'MovieController@create');
Route::get('/movies/{movie}', 'MovieController@show');
Route::get('/sortMovies/{sort}', 'MovieController@sortMovies');
Route::get('/editMovie/{movie}', 'MovieController@edit');
Route::put('/movies/{movie}', 'MovieController@update');
Route::post('/addToList/{movie}/{type}', 'MovieController@storeListItem');
Route::post('/removeFromList/{movie}/{type}', 'MovieController@destroyFromList');
Route::get('/movies/delete/{movie}', 'MovieController@destroy');
Route::get('/responseMovie/{movie}', 'MovieController@responseMovie');
//----------------------------------------------------------------------\\

//------------------------ROUTES FOR CAST-------------------------------\\
Route::get('/cast', 'CastController@index');
Route::get('/users/{user}/favoriteCast', 'CastController@showFavoriteCast');
Route::get('/cast/{cast}', 'CastController@show');
Route::get('/sortCast', 'CastController@sortCast');
//----------------------------------------------------------------------\\

//---------------------ROUTES FOR COMMENTS------------------------------\\
Route::post('/addComment/{movie}', 'CommentController@store');
Route::get('/comments/delete/{comment}', 'CommentController@destroy');
//----------------------------------------------------------------------\\

//------------------------ROUTES FOR LIKEABLE---------------------------\\
Route::get('/likeCast/{cast}/{type}', 'LikeableController@likeCast')->name('likeable.cast');
Route::get('/likeComment/{comment}/{type}', 'LikeableController@likeComment')->name('likeable.comment');
//----------------------------------------------------------------------\\


//-----------------------ROUTES FOR RATING------------------------------\\
Route::post('/addRating/{movie}/{rating}', 'RatingController@store');
Route::get('/ratings/delete/{movie}/{user}', 'RatingController@destroy');
Route::get('/ratings/{movie}', 'RatingController@index');
//----------------------------------------------------------------------\\

//-----------------------ROUTES FOR MOVIELIST------------------------------\\
Route::get('/users/{user}/{type}', 'MovieListController@index')->name('movielist.index');

//----------------------------------------------------------------------\\

//------------------------ROUTES FOR FOLLOW-----------------------------\\
Route::get('/users/{user}/following', 'FollowController@following');
Route::get('/followUser/{user}', 'FollowController@followUser');
Route::get('/users/{user}/followers', 'FollowController@followers');
Route::get('/unfollowUser/{user}', 'FollowController@unfollowUser');
//----------------------------------------------------------------------\\

//------------------------ROUTES FOR SEARCH-----------------------------\\
Route::get('/search', 'SearchController@search');
Route::get('/searchCast', 'SearchController@searchCast');
Route::get('/searchMovies', 'SearchController@searchMovies');
//----------------------------------------------------------------------\\

//-------------------------ROUTES FOR ADMIN-----------------------------\\
Route::get('/showDashboard', 'AdminController@showDashboard');
Route::get('/showUserTable', 'AdminController@showUserTable');
Route::get('/showMovieTable', 'AdminController@showMovieTable');
Route::get('/showCommentTable', 'AdminController@showCommentTable');
Route::get('/showRatingTable', 'AdminController@showRatingTable');
//----------------------------------------------------------------------\\

//-----------------------ROUTES FOR REMINDER----------------------------\\
Route::post('/setReminder/{movie}/{date}', 'ReminderController@store');
//----------------------------------------------------------------------\\

//------------------------ROUTES FOR REPORT-----------------------------\\
Route::get('/report', 'ReportController@report');
//----------------------------------------------------------------------\\

//---------------------ROUTES FOR NOTIFICATIONS-------------------------\\
Route::get('/notifications', 'NotificationController@notifications');
//----------------------------------------------------------------------\\




