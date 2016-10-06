<?php namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class BladeServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::extend(function($view, $compiler) {
            $pattern = $this->createOpenMatcher('spaceless');
            return preg_replace($pattern, '$1<?php ob_start(); ?>$2', $view);
        });

        Blade::extend(function($view, $compiler) {
            $pattern = $this->createOpenMatcher('endspaceless');
            return preg_replace($pattern, '$1<?php echo trim(preg_replace(\'/>\s+</\', \'><\', ob_get_clean())); ?>$2', $view);
        });
    }

    public function createOpenMatcher($function){
        return '/(?<!\w)(\s*)@'.$function.'\(\s*(.*)\)/';
    }
    public function register(){}
}
