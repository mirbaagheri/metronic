<?php


namespace Mirbaagheri\MirMetronic\Load;


interface LoadRepositoryInterface
{
    public function load($type, $name, $app);
}