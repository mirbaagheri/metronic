<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    |
    | Please provide the user model used in Sentinel.
    |
    */

    'css' => [

        'blocks' => [

            'GLOBAL MANDATORY STYLES'   => 'themes/metronic/rtl/assets/global/plugins',

            'THEME GLOBAL STYLES'       => 'themes/metronic/rtl/assets/global/css',

            'THEME LAYOUT STYLES'       => 'themes/metronic/rtl/assets/layouts',

            'PAGE LEVEL PLUGINS'        => 'themes/metronic/rtl/assets/global/plugins',
        ],

    ],

    'themeName'         => 'metronic',

    'pluginsLocation'   => 'assets/global/plugins',

    'layoutsLocation'   => 'assets/layouts',

    'layoutName'        => 'layout4',

    'minify'            => true,

    'pageDirection'     => 'rtl'

];
