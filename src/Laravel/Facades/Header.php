<?php
namespace Mirbaagheri\Metronic\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Header extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'metronic.header';
    }
}
?>