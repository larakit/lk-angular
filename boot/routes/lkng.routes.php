<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 19.06.17
 * Time: 10:52
 */
Route::get('!/lkng/routes', function () {
    \Larakit\Event\Event::notify('lkng::init');
    $routes    = \Larakit\LkNgRoute::routes();
    $otherwise = env('LKNG_OTHERWISE', \Larakit\LkNgRoute::adminUrl());
    $response  = Response::make(view('ng-larakit::ng-routes', compact('routes', 'otherwise')));
    $response->header('Content-Type', 'application/javascript; charset=UTF-8');
    
    return $response;
})
    ->middleware('web')
    ->middleware('auth')
    ->middleware('ng-larakit')
    ->name('lkng.routes');
