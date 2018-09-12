<?php


namespace Mirbaagheri\MirMetronic\Load\Layouts;


interface LayoutRepositoryInterface
{
    public function load($type,$name,$app);

}