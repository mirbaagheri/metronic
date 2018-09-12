<?php
namespace Mirbaagheri\Metronic\Laravel;

use Illuminate\Support\ServiceProvider;

use Mirbaagheri\Metronic\config\IlluminateConfigRepository;
use Mirbaagheri\Metronic\Sidebar\IlluminateSidebarRepository;
use Mirbaagheri\Metronic\Header\IlluminateHeaderRepository;
use Mirbaagheri\Metronic\Load\IlluminateLoadRepository;
    use Mirbaagheri\Metronic\Load\Layouts\IlluminateLayoutRepository;
    use Mirbaagheri\Metronic\Load\Plugins\IlluminatePluginRepository;
    use Mirbaagheri\Metronic\Load\Scripts\IlluminateScriptRepository;
    use Mirbaagheri\Metronic\Load\Styles\IlluminateStyleRepository;
    use Mirbaagheri\Metronic\Load\Customs\IlluminateCustomRepository;
use Mirbaagheri\Metronic\Render\IlluminateRenderRepository;
use Mirbaagheri\Metronic\Metronic;


class MetronicServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->prepareResources();
        $this->registerConfig();
        $this->registerSidebar();
        $this->registerHeader();
        $this->registerLoad();
            $this->registerLayouts();
            $this->registerPlugins();
            $this->registerScripts();
            $this->registerStyles();
            $this->registerCustoms();
        $this->registerRender();
        $this->registerMetronic();
    }

    protected function prepareResources()
    {
        $config = realpath(__DIR__ . '/../config/config.php');
        $this->mergeConfigFrom($config, 'mirbaagheri.metronic');
    }

    protected function registerConfig()
    {
        $this->app->singleton('metronic.config', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $config = new IlluminateConfigRepository($config);
            return $config;
        });
    }

    protected function registerSidebar()
    {
        $this->app->singleton('metronic.sidebar', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $sidebar = new IlluminateSidebarRepository($config);
            return $sidebar;
        });
    }


    protected function registerHeader()
    {
        $this->app->singleton('metronic.header', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $header = new IlluminateHeaderRepository($config);
            return $header;
        });
    }

    protected function registerLoad()
    {
        $this->app->singleton('metronic.load', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $load = new IlluminateLoadRepository($config);
            return $load;
        });
    }

    protected function registerRender()
    {
        $this->app->singleton('metronic.render', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $render = new IlluminateRenderRepository($config);
            return $render;
        });
    }

    protected function registerLayouts()
    {
        $this->app->singleton('metronic.layout', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $layout = new IlluminateLayoutRepository($config);
            return $layout;
        });
    }

    protected function registerPlugins()
    {
        $this->app->singleton('metronic.plugin', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $plugin = new IlluminatePluginRepository($config);
            return $plugin;
        });
    }

    protected function registerScripts()
    {
        $this->app->singleton('metronic.script', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $script = new IlluminateScriptRepository($config);
            return $script;
        });
    }

    protected function registerStyles()
    {
        $this->app->singleton('metronic.style', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $style = new IlluminateStyleRepository($config);
            return $style;
        });
    }

    protected function registerCustoms()
    {
        $this->app->singleton('metronic.custom', function ($app) {
            $config = $app['config']->get('mirbaagheri.metronic');
            $custom = new IlluminateCustomRepository($config);
            return $custom;
        });
    }

    protected function registerMetronic()
    {
        $this->app->singleton('metronic', function ($app) {

            $mirMetronic = new Metronic(

                $app['metronic.header'],
                $app['metronic.sidebar'],
                $app['metronic.load'],
                    $app['metronic.layout'],
                    $app['metronic.plugin'],
                    $app['metronic.script'],
                    $app['metronic.style'],
                    $app['metronic.custom'],
                $app['metronic.render'],
                $app['metronic.config']

            );

            return $mirMetronic;
        });
    }
}

?>