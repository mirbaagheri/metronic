<?php

namespace Mirbaagheri\Metronic\Load\Layouts;

use Config;
use InvalidArgumentException;


class IlluminateLayoutRepository implements LayoutRepositoryInterface
{

    public $locationStart;

    private $config;
    private $dataBase;
    private $app;
    private $name;
    private $type;

    public function prepare($app)
    {
        $this->app = $app;
        $this->load('layouts','layout-rtl',$this->app);
    }

    private function setLocationStart()
    {
        $this->locationStart = 'themes/'. $this->config['themeName']. '/'. $this->config['themeVersion']. '/'. $this->config['pageDirection'];
    }

    private function loadConfig()
    {
        $this->config = Config::get('mirbaagheri.metronic');
    }

    private function checkTheme($blockValue)
    {
        if(array_key_exists('link',$blockValue))
        {
            foreach($blockValue['link'] as $keyItem => $value)
            {
                if(false !== $key = array_search('themes', $value['href']))
                {
                    $key-=2;
                    $blockValue['link'][$keyItem]['href'][$key] = 'layout';
                    $blockValue['link'][$keyItem]['href'][$key+3] = 'darkblue-rtl.min.css';
                }
            }
        }
        //dd($blockValue);
        return $blockValue;
    }

    public function load($type,$name,$app)
    {
        $this->loadConfig();
        $this->app = $app;
        $this->name = $name;
        $this->type = $type;
        $this->setLocationStart();
        $this->dataBase = $this->app->load->dataBase['layouts'];

        if(array_key_exists($this->config['layoutName'],$this->dataBase))
        {
            //Tag Name
            foreach($this->dataBase[$this->config['layoutName']] as $tagName => $tagNameValue)
            {
                if(is_array($tagNameValue))
                {
                    foreach($tagNameValue as $blockName => $blockValue)
                    {
                        if(is_array($blockValue))
                        {
                            $blockValue = $this->checkTheme($blockValue);
                            $this->app->render->add2Queue($blockValue,$this->type,$this->app,$tagName,$blockName);
                        }
                    }
                }
                else exit('Exception error 4876!');
            }
        }
        else exit('Layout not exists!: '.$this->config['layout'].$this->config['layoutName']);
    }
}