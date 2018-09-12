<?php

namespace Mirbaagheri\MirMetronic\Load\Scripts;


interface ScriptRepositoryInterface
{
    public function load($type,$name,$app);

}