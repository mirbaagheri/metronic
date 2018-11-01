<?php

namespace Mirbaagheri\Metronic\Load;

use Config;
use File;
use InvalidArgumentException;


class IlluminateLoadRepository implements LoadRepositoryInterface
{

    protected $blocks;
    protected $blockSrc;
    protected $file;
    protected $src;

    protected $data = [];
    protected $blockName;
    protected $blockStart;
    protected $blockEnd;

    private $config;
    public  $dataBase;
    public  $metronicQueue = [];
    public  $metronicQueueFinal = [];
    private $app;
    private $name;
    private $type;


    public function defaults($app)
    {
        $this->app = $app;
        $this->loadConfig();
        $this->loadDatabase();
        $this->app->layouts->prepare($this->app);
    }

    private function loadConfig()
    {
        $this->config = Config::get('mirbaagheri.metronic');
    }

    private function loadDatabase($src = 'themes/metronic/4.6.0/database.json')
    {
        $this->app->load->dataBase = json_decode(File::get($src),true);
    }

    public function typeDetector($arr)
    {
        if($this->type == 'customs')
            $this->app->customs->load($this->type,$arr,$this->app);
        else
            foreach($arr as $name)
            {
                $this->name = $name;
                $property = $this->type;
                if(property_exists ($this->app,$property))
                    $this->app->$property->load($this->type,$this->name,$this->app);
                else throw new InvalidArgumentException("Invalid type. please provide valid type name in your load. such as plugins,styles and etc.");
            }
    }

    public function load($type,$arr,$app)
    {
        $this->loadConfig();
        $this->app  = $app;
        $this->type = str_plural($type);

        if(!isset($this->dataBase))
            $this->loadDatabase();
        $this->typeDetector($arr);
    }

}