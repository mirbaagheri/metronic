<?php

namespace Mirbaagheri\MirMetronic\Load\Scripts;

use Config;
use InvalidArgumentException;


class IlluminateScriptRepository implements ScriptRepositoryInterface
{

    public $locationStart;

    private $config;
    private $dataBase;
    private $app;
    private $name;
    private $type;

    private function setLocationStart()
    {
        $this->locationStart = 'themes/'. $this->config['themeName']. '/'. $this->config['pageDirection'];
    }

    private function loadConfig()
    {
        $this->config = Config::get('mirbaagheri.mirmetronic');
    }

    public function load($type,$name,$app)
    {
        $this->loadConfig();
        $this->app = $app;
        $this->name = $name;
        $this->type = $type;
        $this->setLocationStart();
        $this->dataBase = $this->app->load->dataBase['scripts'];

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
                else exit('Exception error 4877!');
            }
        }
        else exit('Script not exists!: '.$this->name);
    }
}