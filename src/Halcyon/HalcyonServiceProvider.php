<?php namespace Winter\Storm\Halcyon;

use Winter\Storm\Halcyon\Datasource\Resolver;
use Winter\Storm\Support\ServiceProvider;
use Illuminate\Cache\CacheManager;

/**
 * Service provider
 *
 * @author Alexey Bobkov, Samuel Georges
 */
class HalcyonServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        Model::setDatasourceResolver($this->app['halcyon']);

        Model::setEventDispatcher($this->app['events']);

        Model::setCacheManager($this->app['cache']);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // The halcyon resolver is used to resolve various datasources,
        // since multiple datasources might be managed.
        $this->app->singleton('halcyon', function ($app) {
            return new Resolver;
        });

        if (MemoryCacheManager::isEnabled()) {
            $this->app->extend(CacheManager::class, function ($cacheManager, $app) {
                return new MemoryCacheManager($app);
            });
        }
    }
}
