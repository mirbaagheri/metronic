<?php

namespace Mirbaagheri\MirMetronic\Load\Styles;

use Config;
use File;
use InvalidArgumentException;


class IlluminateStyleRepository implements StyleRepositoryInterface
{

    private $config;
    private $app;


    private function setLocationStart()
    {
        $this->locationStart = 'themes/'. $this->config['themeName']. '/'. $this->config['pageDirection'];
    }

    private function loadConfig()
    {
        $this->config = Config::get('mirbaagheri.mirmetronic');
    }

    protected function globalMandatoryStyles()
    {
        $this->loadConfig();
        $this->load('plugin','font-awesome');
        $this->load('plugin','simple-line-icons');
        $this->load('plugin','bootstrap');
        $this->load('plugin','bootstrap-switch');
    }

    public function load($type,$name,$app)
    {
        $this->loadConfig();
        $this->app = $app;
        $this->name = $name;
        $this->type = $type;
        $this->setLocationStart();
        $this->dataBase = $this->app->load->dataBase['styles'];

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
        else dd('Style "'.$name.'" does not exists.');
    }

}