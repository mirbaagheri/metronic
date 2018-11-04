<?php

namespace Mirbaagheri\Metronic\Load\Plugins;

class IlluminatePluginRepository implements PluginRepositoryInterface
{

    public $locationStart;

    protected $data = [];
    protected $blockName;
    protected $blockStart;
    protected $blockEnd;
    protected $config;

    private $dataBase;
    private $app;
    private $type;

    public function __construct($config = null)
    {
        if (isset($config)) {
            $this->config = $config;
        }
    }

    private function setLocationStart()
    {
        $this->locationStart = $this->config['location'];
    }

    public function load($type,$name,$app)
    {
        $this->app = $app;
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