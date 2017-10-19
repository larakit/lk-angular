<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 19.06.17
 * Time: 10:53
 */
Route::get('!/lk-angular-js', function () {
    $modules = \Larakit\LkNgModule::all();
    $modules = '"' . implode('", "', $modules) . '"';
    
    return response( '(function () {
    angular.module("larakit",[' . $modules . '])
    angular.module("larakit").constant("CSRF_TOKEN", \'' . csrf_token() . '\');
})();
    ',200, [
        'Content-Type'=> 'application/javascript'
    ]) ;
})->middleware('web');