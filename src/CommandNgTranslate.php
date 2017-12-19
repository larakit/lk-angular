<?php

namespace Larakit;

use Illuminate\Support\Arr;

class CommandNgTranslate extends \Illuminate\Console\Command {
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'larakit:ng:translate';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сгенерировать языковые файлы GUI';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $langs = (array) config('app.locales');
        $ret   = [];
        foreach($langs as $lang) {
            $path = public_path('/!/locales/' . $lang . '.json');
            $dir  = dirname($path);
            if(!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $this->info($lang);
            $files = rglob('*php', 0, resource_path('lang/' . $lang));
            foreach($files as $file) {
                $file = str_replace('\\', '/', $file);
                $file = str_replace(resource_path('lang/' . $lang), '', $file);
                $file = str_replace('.php', '', $file);
                $file = trim($file, '/');
                $file = str_replace('/', '.', $file);
                //                dump($file);
                //                dump(\Lang::get($file));
                Arr::set($ret, $file, \Lang::get($file, [], $lang, false));
            }
            file_put_contents($path, json_encode($ret), JSON_PRETTY_PRINT);
        }
        $this->info('Языковые файлы сформированы');
    }
    
}
