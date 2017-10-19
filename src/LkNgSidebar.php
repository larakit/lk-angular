<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 22.05.17
 * Time: 13:27
 */

namespace Larakit;

use Illuminate\Support\Arr;

class LkNgSidebar {
    
    protected static $sidebars = [];
    protected        $items    = [];
    
    /**
     * @param $section
     *
     * @return LkNgSidebar
     */
    static function section($section, $folder = null) {
        if(!isset(self::$sidebars[$section][$folder])) {
            self::$sidebars[$section][$folder] = new LkNgSidebar();
        }
        
        return self::$sidebars[$section][$folder];
    }
    
    function item($access_name, $text, $icon = null, $url = null) {
        $access_name = str_replace('/', '.', $access_name);
        $path        = str_replace('.', '._items_.', $access_name);
        Arr::set($this->items, $path . '.text', $text);
        Arr::set($this->items, $path . '.access_name', $access_name);
        Arr::set($this->items, $path . '.url', $url);
        Arr::set($this->items, $path . '.icon', $icon);
        Arr::set($this->items, $path . '._items_', []);
        if(!Arr::get($this->items, $path . '.childs')) {
            Arr::set($this->items, $path . '.childs', []);
        }
        if($url) {
            $childs   = Arr::get($this->items, $path . '.childs');
            $childs[] = $url;
            $childs   = array_unique($childs);
            Arr::set($this->items, $path . '.childs', $childs);
        }
        $parents = explode('.', $access_name);
        while(array_pop($parents) != null) {
            if(count($parents)) {
                $this->autoCreateParent(implode('.', $parents), $url);
            }
        }
        
        return $this;
    }
    
    /**
     * @param        $access_name
     * @param        $cnt
     * @param string $class
     *
     * @return $this
     */
    function addLabel($access_name, $text, $class = 'success') {
        $access_name = str_replace('/', '.', $access_name);
        if(mb_strpos($access_name, '.')) {
            $path = str_replace('.', '._items_.', $access_name) . '.item.labels';
        } else {
            $path = $access_name . '.labels';
        }
        $labels   = (array) Arr::get($this->items, $path);
        $labels[] = compact('text', 'class');
        Arr::set($this->items, $path, $labels);
        
        return $this;
    }
    
    /**
     * $access_name = 'admin.plugins.module.config_module';
     * $path = 'admin._items_.plugins._items_.module._items_.config';
     * $default_title = 'Config Module';
     *
     * @param type $access_name
     */
    function autoCreateParent($access_name, $url) {
        $path          = str_replace('.', '._items_.', $access_name);
        $arr           = explode('.', $access_name);
        $tmp           = array_pop($arr);
        $default_title = ucwords(str_replace('_', ' ', $tmp));
        if(!Arr::get($this->items, $path . '._items_')) {
            Arr::set($this->items, $path . '._items_', []);
        }
        Arr::set($this->items, $path . '.access_name', $access_name);
        if(!Arr::get($this->items, $path . '.text')) {
            Arr::set($this->items, $path . '.text', $default_title);
        }
        if(!Arr::get($this->items, $path . '.url')) {
            Arr::set($this->items, $path . '.url', null);
        }
        if(!Arr::get($this->items, $path . '.icon')) {
            Arr::set($this->items, $path . '.icon', null);
        }
        if(!Arr::get($this->items, $path . '.childs')) {
            Arr::set($this->items, $path . '.childs', []);
        }
        if(!Arr::get($this->items, $path . '.labels')) {
            Arr::set($this->items, $path . '.labels', []);
        }
        if($url) {
            $childs   = Arr::get($this->items, $path . '.childs');
            $childs[] = $url;
            $childs   = array_unique($childs);
            Arr::set($this->items, $path . '.childs', $childs);
        }
    }
    
    function getItems() {
        return $this->values($this->items);
    }
    
    function values($items) {
        $ret = [];
        foreach($items as $k => $v) {
            $ret[] = [
                'text'        => Arr::get($v, 'text'),
                'access_name' => Arr::get($v, 'access_name'),
                'url'         => Arr::get($v, 'url'),
                'icon'        => Arr::get($v, 'icon'),
                'labels'      => Arr::get($v, 'labels', []),
                'childs'      => Arr::get($v, 'childs'),
                '_items_'     => $this->values(Arr::get($v, '_items_', [])),
            ];
        }
        
        return $ret;
    }
    
    static function sidebars() {
        $ret = [];
        foreach(self::$sidebars as $section => $data) {
            foreach($data as $folder => $sidebar) {
                $ret[$section][$folder] = $sidebar->getItems();
            }
            if(isset($ret[$section][null])) {
                $tmp = $ret[$section][null];
                unset($ret[$section][null]);
                $ret[$section] = [null => $tmp] + $ret[$section];
            }
        }
        
        return $ret;
    }
    
}