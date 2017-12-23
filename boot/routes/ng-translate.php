<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 19.06.17
 * Time: 10:53
 */
if(config('app.debug')) {
    Route::get('!/locales/{lang}.json', function () {
        $ret           = [];
        $lang          = Request::route('lang');
        $files         = rglob('*php', 0, resource_path('lang/' . $lang));
        $resource_path = resource_path('lang/' . $lang);
        $resource_path = str_replace('\\', '/', $resource_path);
        foreach($files as $file) {
            
            $file = str_replace('\\', '/', $file);
            $file = str_replace($resource_path, '', $file);
            $file = str_replace('.php', '', $file);
            $file = trim($file, '/');
            $file = str_replace('/', '.', $file);
            \Illuminate\Support\Arr::set($ret, $file, \Lang::get($file, [], $lang, false));
        }
        
        return $ret;
    })->middleware('web');
}