<?php


namespace Mirbaagheri\Metronic\Load\Layouts;


interface LayoutRepositoryInterface
{
    public function load($type,$name,$app);

}