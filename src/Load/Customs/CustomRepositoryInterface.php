<?php


namespace Mirbaagheri\MirMetronic\Load\Customs;


interface CustomRepositoryInterface
{
    public function load($type,$name,$app);

}