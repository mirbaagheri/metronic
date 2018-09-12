<?php
namespace Mirbaagheri\MirMetronic\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Sidebar extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'metronic.sidebar';
    }

}
?>