<?php
namespace Shahab\EA;

use Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Shahab\EA\EntityAuthorization;

class EAServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/migrations/' => database_path('/migrations')
        ], 'migrations');

        Blade::directive('EApageRole', function($pageName) {
            return "<?php echo EAC::bladePageRole(Route::currentRouteName()); ?>";
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('EAC', function()
        {
            return new EntityAuthorization();
        });
    }
}
