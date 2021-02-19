<?php

use App\Models\User;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});





// $router->group(['prefix' => 'v1','middleware'=>[]],function() use ($router){

//     $router->get('users', function () {
//         // Matches The "/accounts/{accountId}/detail" URL
//         return 'Users';
//     });

// });

$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->post('auth/login', 'AuthController@login');

    $router->get('classroom', 'ClassroomController@index');

    $router->get('users', function () {
        $users = User::get();
        return $users;
    });

    $router->group(['prefix' => 'auth','middleware'=>['auth']],function() use ($router){

        $router->get('user', 'AuthController@user');
        $router->post('user/update', 'AuthController@user_update');
        $router->get('refresh', 'AuthController@refresh');


    });

    $router->group(['prefix' => 'user','middleware'=>['auth']],function() use ($router){

        $router->get('classroom', 'ClassroomController@index');
        $router->get('classroom/chapter', 'ChapterController@index');

    });



    // $router->group(['middleware'=>['auth']], function () use ($router) {
    //     $router->get('classroom', 'ClassroomController@index');
    // });


});
