<?php
/**
 * Created by PhpStorm.
 * User: aberdnikov
 * Date: 17.10.2017
 * Time: 23:33
 */

namespace Larakit;

class LkNgModule {
    
    protected static $ng_larakit_modules = [];
    
    static function register($module) {
        self::$ng_larakit_modules[$module] = $module;
    }
    
    static function all() {
        return array_values(self::$ng_larakit_modules);
    }
}