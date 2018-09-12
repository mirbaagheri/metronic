<?php


namespace Mirbaagheri\MirMetronic\Load\Plugins;


interface PluginRepositoryInterface
{
    public function load($type,$name,$app);

}