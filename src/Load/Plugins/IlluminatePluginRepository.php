<?php

namespace Mirbaagheri\Metronic\Load\Plugins;

use Config;


class IlluminatePluginRepository implements PluginRepositoryInterface
{

    protected $data = [];
    protected $blockName;
    protected $blockStart;
    protected $blockEnd;

    private $config;
    private $dataBase;
    private $app;
    private $type;

    private function setLocationStart()
    {
        $this->locationStart = 'themes/'. $this->config['themeName']. '/'. $this->config['themeVersion']. '/'. $this->config['pageDirection'];
    }

    private function loadConfig()
    {
        $this->config = Config::get('mirbaagheri.metronic');
    }

    public function load($type,$name,$app)
    {
        $this->loadConfig();
        $this->app = $app;
        //$this->name = $name;
        $this->type = $type;
        $this->setLocationStart();
        $this->dataBase = $this->app->load->dataBase['plugins'];

        if(array_key_exists($name,$this->dataBase))
        {
            //Tag Name
            foreach($this->dataBase[$name] as $tagName => $tagNameValue)
            {
                if(is_array($tagNameValue))
                {
                    foreach($tagNameValue as $blockName => $blockValue)
                    {
                        if(is_array($blockValue))
                        {
                            $this->app->render->add2Queue($blockValue,$this->type,$this->app,$tagName,$blockName);
                        }
                    }
                }
                else exit('Exception error 4876!');
            }
        }
        else dd('Plugin "'.$name.'" does not exists.');
    }

}