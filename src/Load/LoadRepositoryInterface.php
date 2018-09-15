<?php


namespace Mirbaagheri\Metronic\Load;


interface LoadRepositoryInterface
{
    public function load($type, $name, $app);
}