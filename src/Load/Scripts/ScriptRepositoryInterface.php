<?php

namespace Mirbaagheri\Metronic\Load\Scripts;


interface ScriptRepositoryInterface
{
    public function load($type,$name,$app);

}