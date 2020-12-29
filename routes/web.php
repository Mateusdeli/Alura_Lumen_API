<?php

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

$router->group(['prefix' => 'api', 'middleware' => 'authenticate'], function() use ($router) {

    $router->get('/', function () use ($router) {
        return redirect()->route('series.index');
    });

    $router->group(['prefix' => 'series'], function() use($router) {
        $router->get('/', [
            'as' => 'series.index', 'uses' => 'SeriesController@index'
        ]);

        $router->post('/', [
            'as' => 'series.store', 'uses' => 'SeriesController@store'
        ]);
    
        $router->get('{id}', [
            'as' => 'series.show', 'uses' => 'SeriesController@show'
        ]);
    
        $router->put('{id}', [
            'as' => 'series.update', 'uses' => 'SeriesController@update'
        ]);
    
        $router->delete('{id}', [
            'as' => 'series.destroy', 'uses' => 'SeriesController@destroy'
        ]);

        $router->get('/{serie_id}/episodios', [
            'as' => 'series.episodios', 'uses' => 'EpisodiosController@buscaPorSerie'
        ]);
    });

    $router->group(['prefix' => 'episodios'], function() use($router) {
        $router->get('/', [
            'as' => 'episodios.index', 'uses' => 'EpisodiosController@index'
        ]);
    
        $router->post('/', [
            'as' => 'episodios.store', 'uses' => 'EpisodiosController@store'
        ]);
    
        $router->get('{id}', [
            'as' => 'episodios.show', 'uses' => 'EpisodiosController@show'
        ]);
    
        $router->put('{id}', [
            'as' => 'episodios.update', 'uses' => 'EpisodiosController@update'
        ]);
    
        $router->delete('{id}', [
            'as' => 'episodios.destroy', 'uses' => 'EpisodiosController@destroy'
        ]);
    });
});

$router->post('/api/login', 'AuthController@login');
 
