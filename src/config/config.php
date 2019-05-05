<?php

return [

    'scripts' => [

    ],

    'plugins' => [

        'location'  => 'assets/plugins'
    ],

    'css' => [

        'blocks' => [

            'GLOBAL MANDATORY STYLES'   => 'assets/plugins',
            'THEME GLOBAL STYLES'       => 'themes/metronic/rtl/assets/global/css',
            'THEME LAYOUT STYLES'       => 'themes/metronic/rtl/assets/layouts',
            'PAGE LEVEL PLUGINS'        => 'assets/plugins',
        ],

    ],

    'themeName'         => 'metronic',
    'themeVersion'      => '4.6.0',
    'pluginsLocation'   => 'assets/plugins',
    'layoutsLocation'   => 'assets/layouts',
    'layoutName'        => 'layout4',
    'minify'            => true,
    'pageDirection'     => 'rtl'

];
