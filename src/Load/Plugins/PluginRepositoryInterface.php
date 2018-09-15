<?php


namespace Mirbaagheri\Metronic\Load\Plugins;


interface PluginRepositoryInterface
{
    public function load($type,$name,$app);

}