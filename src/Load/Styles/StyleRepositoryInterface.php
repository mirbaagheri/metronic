<?php


namespace Mirbaagheri\MirMetronic\Load\Styles;


interface StyleRepositoryInterface
{
    public function load($type, $name, $app);

}