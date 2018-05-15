<?php 

namespace Oniti\WebPackHelper;

use Illuminate\Support\ServiceProvider;
use App;
use Illuminate\Foundation\AliasLoader;

class WebpackHelperProvider extends ServiceProvider{
 
 
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
 
    public function boot(){
        $loader = AliasLoader::getInstance();
        $loader->alias('WebpackHelper', \Oniti\WebPackHelper\WebpackHelperFacade::class);

        $this->publishes([
            __DIR__.'/config' => base_path('config')
        ]);
    }
 
    public function register() {
        App::bind('WebpackHelper', function()
        {
            return new \Oniti\WebPackHelper\WebPackHelper;
        });
    }
 
}