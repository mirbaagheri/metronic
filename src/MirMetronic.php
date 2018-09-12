<?php

namespace Mirbaagheri\Metronic;

use Mirbaagheri\Metronic\Header\HeaderRepositoryInterface;
use Mirbaagheri\Metronic\Sidebar\SidebarRepositoryInterface;
use Mirbaagheri\Metronic\Load\LoadRepositoryInterface;
    use Mirbaagheri\Metronic\Load\Layouts\LayoutRepositoryInterface;
    use Mirbaagheri\Metronic\Load\Plugins\PluginRepositoryInterface;
    use Mirbaagheri\Metronic\Load\Scripts\ScriptRepositoryInterface;
    use Mirbaagheri\Metronic\Load\Styles\StyleRepositoryInterface;
    use Mirbaagheri\Metronic\Load\Customs\customRepositoryInterface;
use Mirbaagheri\Metronic\Render\RenderRepositoryInterface;
use Mirbaagheri\Metronic\config\ConfigRepositoryInterface;

use BadMethodCallException;

class Metronic
{

    protected $call = array();
    protected $availableMethods = array();

    protected $design;
    protected $direction;
    protected $layout;

    /**
     * The Header repository.
     *
     * @var \Mirbaagheri\Metronic\Header\HeaderRepositoryInterface
     */
    protected $header;

    /**
     * The Sidebar repository.
     *
     * @var \Mirbaagheri\Metronic\Sidebar\SidebarRepositoryInterface
     */
    protected $sidebar;

    /**
     * The primary Config.
     *
     * @var string[] \Mirbaagheri\Metronic\config\config
     */
    protected $config;

    /**
     * The Layout theme.
     *
     * @var \Mirbaagheri\Metronic\Sidebar\SidebarRepositoryInterface
     */
    //protected $layout;

    /**
     * Create a new Metronic instance.
     *
     * @param  \Mirbaagheri\Metronic\Header\HeaderRepositoryInterface  $header
     * @param  \Mirbaagheri\Metronic\Sidebar\SidebarRepositoryInterface  $sidebar
     * @param  \Mirbaagheri\Metronic\Load\LoadRepositoryInterface  $load
     * * * @param  \Mirbaagheri\Metronic\Load\Layouts\LayoutRepositoryInterface  $layouts
     * * * @param  \Mirbaagheri\Metronic\Load\Plugins\PluginRepositoryInterface  $plugins
     * * * @param  \Mirbaagheri\Metronic\Load\Scripts\ScriptRepositoryInterface  $scripts
     * * * @param  \Mirbaagheri\Metronic\Load\Styles\StyleRepositoryInterface    $styles
     * @param  \Mirbaagheri\Metronic\Render\RenderRepositoryInterface  $render
     * @param  \Mirbaagheri\Metronic\config\ConfigRepositoryInterface  mixed[] $config
     */
    public function __construct(
        HeaderRepositoryInterface  $header,
        SidebarRepositoryInterface $sidebar,
        LoadRepositoryInterface    $load,
            LayoutRepositoryInterface  $layouts,
            PluginRepositoryInterface  $plugins,
            ScriptRepositoryInterface  $scripts,
            StyleRepositoryInterface   $styles,
            CustomRepositoryInterface  $customs,
        RenderRepositoryInterface      $render,
        ConfigRepositoryInterface  $config

    )
    {
        $this->header   = $header;
        $this->sidebar  = $sidebar;
        $this->load     = $load;
            $this->layouts  = $layouts;
            $this->plugins  = $plugins;
            $this->scripts  = $scripts;
            $this->styles   = $styles;
            $this->customs  = $customs;
        $this->render       = $render;
        $this->config   = $config;

    }

    public function getSidebarRepository()
    {
        return $this->sidebar;
    }

    public function getLoadRepository()
    {
        return $this->load;
    }

    public function getRenderRepository()
    {
        return $this->render;
    }

    public function getLayoutRepository()
    {
        return $this->layouts;
    }

    public function getPluginRepository()
    {
        return $this->plugins;
    }

    public function getScriptRepository()
    {
        return $this->scripts;
    }

    public function getStyleRepository()
    {
        return $this->styles;
    }

    public function getCustomRepository()
    {
        return $this->customs;
    }

    protected function sidebarMethods()
    {
        if (empty($this->availableMethods['sidebar']))
        {
            $methods = get_class_methods($this->sidebar);
            $this->availableMethods['sidebar'] = array_diff($methods, ['__construct']);
        }
    }

    protected function loadMethods()
    {
        if (empty($this->availableMethods['load']))
        {
            $methods = get_class_methods($this->load);
            $this->availableMethods['load'] = array_diff($methods, ['__construct']);
        }
    }

    protected function renderMethods()
    {
        if (empty($this->availableMethods['render']))
        {
            $methods = get_class_methods($this->render);
            $this->availableMethods['render'] = array_diff($methods, ['__construct']);
        }
    }

    protected function layoutMethods()
    {
        if (empty($this->availableMethods['layout']))
        {
            $methods = get_class_methods($this->layouts);
            $this->availableMethods['layout'] = array_diff($methods, ['__construct']);
        }
    }

    protected function pluginMethods()
    {
        if (empty($this->availableMethods['plugin']))
        {
            $methods = get_class_methods($this->plugins);
            $this->availableMethods['plugin'] = array_diff($methods, ['__construct']);
        }
    }

    protected function scriptMethods()
    {
        if (empty($this->availableMethods['script']))
        {
            $methods = get_class_methods($this->scripts);
            $this->availableMethods['script'] = array_diff($methods, ['__construct']);
        }
    }

    protected function styleMethods()
    {
        if (empty($this->availableMethods['style']))
        {
            $methods = get_class_methods($this->styles);
            $this->availableMethods['style'] = array_diff($methods, ['__construct']);
        }
    }

    protected function customMethods()
    {
        if (empty($this->availableMethods['custom']))
        {
            $methods = get_class_methods($this->customs);
            $this->availableMethods['custom'] = array_diff($methods, ['__construct']);
        }
    }

    public function config($value)
    {
        $this->config->set($value);
    }

    public function setPageDirection($direction)
    {
        $this->direction = $direction;
    }

    public function setDesign($designName)
    {
        $this->design = $designName;
    }

    public function loadLayout($layoutName)
    {
        $this->layout = $layoutName;
    }

    public function render($area)
    {
        return $this->render->render($area,$this);
    }

//    public function prepareDefaults()
//    {
//        //return call_user_func_array([$this->getLoadRepository(), 'prepare'], array($this));
//        $this->load->prepare($this);
//    }

    public function __call($method, $parameters)
    {
        $this->CallDetect($method);
        $Repository_Method = $this->call['model'].'Methods';

        if(method_exists($this,$Repository_Method))
        {
            $this->$Repository_Method();
            // $Repository_Method => loadMethods and etc...
            if (in_array($this->call['method'], $this->availableMethods[$this->call['model']])) {
                $Repository_Name = 'get'.ucfirst($this->call['model']).'Repository';
                $CallMethod = $this->$Repository_Name();
                // push app variable to request
                array_push($parameters,$this);
                return call_user_func_array([$CallMethod, $this->call['method']], $parameters);
            }
        }
        else if(method_exists($this,$method))
        {
            dd('what what what?!!!');
            return $this->$method($parameters);
        }
            throw new BadMethodCallException("Call to undefined method {$this->call['model']}::{$method}()");

    }

    private function CallDetect($method)
    {
        $method = $this->splitAtUpperCase($method);
        $this->call['model'] = strtolower ($method[1]);
        unset($method[1]);
        $this->call['method'] = implode('',$method);
    }

    private function splitAtUpperCase($s)
    {
        return preg_split('/(?=[A-Z])/', $s, -1, PREG_SPLIT_NO_EMPTY);
    }

}