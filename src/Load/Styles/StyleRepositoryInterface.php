<?php


namespace Mirbaagheri\Metronic\Load\Styles;


interface StyleRepositoryInterface
{
    public function load($type, $name, $app);

}