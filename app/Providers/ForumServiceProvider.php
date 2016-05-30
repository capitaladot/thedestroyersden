<?php

namespace App\Providers;

use App\Post;
use App\Thread;
use Riari\Forum\Models\Observers\PostObserver;
use Riari\Forum\Models\Observers\ThreadObserver;
use Riari\Forum\ForumServiceProvider as FSP;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class ForumServiceProvider extends FSP{
    /**
     * Bootstrap the application events.
     *
     * @param  Router  $router
     * @param  GateContract  $gate
     * @return void
     */
    public function boot(Router $router, GateContract $gate)
    {
        $this->baseDir = base_path().'/vendor/riari/laravel-forum/';

        $this->setPublishables();
        $this->loadStaticFiles();

        $this->namespace = 'App\Http\Controllers\Forum';

        $this->observeModels();

        $this->registerPolicies($gate);

        if (config('forum.routing.enabled')) {
            $this->registerMiddleware($router);
            $this->loadRoutes($router);
        }
    }
    /**
     * Initialise model observers.
     *
     * @return void
     */
    protected function observeModels()
    {
        Thread::observe(new ThreadObserver);
        Post::observe(new PostObserver);
    }
}
