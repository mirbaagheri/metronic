<?php

namespace Mirbaagheri\Metronic\Load\Customs;

use Config;
use InvalidArgumentException;


class IlluminateCustomRepository implements CustomRepositoryInterface
{
    protected $blockName;
    protected $blockStart;
    protected $blockEnd;

    private $config;
    private $app;
    private $type;

    private function setLocationStart()
    {
        $this->locationStart = 'themes/'. $this->config['themeName']. '/'. $this->config['themeVersion']. '/'. $this->config['pageDirection'].'/assets/customs';
    }

    private function loadConfig()
    {
        $this->config = Config::get('mirbaagheri.metronic');
    }

    public function load($type,$arr,$app)
    {
        $this->loadConfig();
        $this->setLocationStart();
        $this->app = $app;
        $this->type = $type;
        $blockName  = 'Customs';

        foreach($arr as $tagName => $blockValue)
        {
            $this->app->render->add2Queue($blockValue,$this->type,$this->app,$tagName,$blockName);
        }
    }

}