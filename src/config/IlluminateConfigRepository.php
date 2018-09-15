<?php

namespace Mirbaagheri\Metronic\config;

use Config;
use InvalidArgumentException;

class IlluminateConfigRepository implements ConfigRepositoryInterface
{
    public function set($config)
    {
        if(is_array($config))
        {
            foreach($config as $key => $value)
            {
                Config::set('mirbaagheri.metronic.'.$key,$value);
            }
            return true;
        }
        throw new InvalidArgumentException('Config argument is not a valid array.');

    }
}