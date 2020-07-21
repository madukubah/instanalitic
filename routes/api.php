<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::prefix('v1')->group(function () {
//     Route::get('roles', 'Admin\RoleController@index');
// });
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        // Below mention routes are public, user can access those without any restriction.
        // Create New User
        Route::post('register', 'AuthController@register');
        // Login User
        Route::post('login', 'AuthController@login');
        
        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');
        
        // Below mention routes are available only for the authenticated users.
        Route::middleware('auth:api')->group(function () {
            // update
            Route::post('update', 'AuthController@update');
            // uploadProfilPict
            Route::post('upload-photo', 'AuthController@uploadProfilPict');
            // Get user info
            Route::get('user', 'AuthController@user');
            // Logout user from application
            Route::post('logout', 'AuthController@logout');
        });
    });

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/sample_posts', 'Admin\SamplePostController@index');
        Route::get('/sample_posts/count', 'Admin\SamplePostController@count');

        Route::get('/words', 'Admin\WordCountController@index');
        Route::get('/words/count', 'Admin\WordCountController@count');

        Route::get('/posts', 'Admin\PostController@index');
        Route::get('/posts/count', 'Admin\PostController@count');

        Route::get('/accounts', 'Admin\AccountController@index');
        Route::get('/accounts/count', 'Admin\AccountController@count');

        Route::get('/sample_accounts', 'Admin\SampleAccountController@index');
        Route::get('/sample_accounts/count', 'Admin\SampleAccountController@count');

        Route::get('/cluster_words', 'Admin\ClusterWordController@index');
        Route::get('/cluster_words/count', 'Admin\ClusterWordController@count');
        Route::resource('/evaluations', 'Admin\EvaluationController');

        Route::resource('/base_class', 'Admin\BaseClassController');
        Route::resource('/temp_target', 'Admin\TempTargetController');
    });
});