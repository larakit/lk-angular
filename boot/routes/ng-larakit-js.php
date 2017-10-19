<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 19.06.17
 * Time: 10:53
 */
Route::get('!/ng-larakit-js', function () {
    $modules = \Larakit\LkNgModule::all();
    $modules = '"' . implode('", "', $modules) . '"';
    
    return '(function () {
    
    angular.module("larakit").constant("CSRF_TOKEN", \'' . csrf_token() . '\');
    angular.module("ng-larakit",[' . $modules . '])})();';
})->middleware('web');