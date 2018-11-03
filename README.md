```
Attention: This package is beta. I'll complete this package in future.
```
-------------


Installation instructions :
-------------
1. composer require mirbaagheri/metronic

2. Add bellow line to `config/app.php` in section `providers`:
````
'Mirbaagheri\Metronic\Laravel\MetronicServiceProvider::class'
````

3. Add bellow lines to `config/app.php` in section `aliases`:
````
'Metronic'      => Mirbaagheri\Metronic\Laravel\Facades\Metronic::class
'Sidebar'       => Mirbaagheri\Metronic\Laravel\Facades\Sidebar::class
'PageHeader'    => Mirbaagheri\Metronic\Laravel\Facades\Header::class
````

Publish config :
-------------
Use bellow command in your terminal to publish configuration file: 
```
php artisan vendor:publish --provider="Mirbaagheri\Metronic\Laravel\MetronicServiceProvider"
```

Sample usage :
-------------
Set default config:
```
Metronic::config([
            'minify'        => false,
            'pageDirection' => 'rtl',
            'layoutName'    => 'layout4',
            'layoutTheme'   => 'layout|darkblue'
        ]);
```

Load core plugins:
```
Metronic::loadLoad('plugin',['jquery','js.cookie','jquery-slimscroll','jquery.blockui']);
```

Load global mandatory styles:
```
Metronic::loadLoad('plugin',['font-awesome','simple-line-icons','bootstrap']);
```

Load page level plugins:
```
Metronic::loadLoad('plugin',['bootstrap-select','fuelux','bootstrap-touchspin']);
```

Load theme global styles:
```
Metronic::loadLoad('style',['components-md-rtl','plugins-md-rtl']);
```

Load theme global scripts:
```$xslt
Metronic::loadLoad('script',['app','components-bootstrap-select']);
```

load default dependency:
```$xslt
Metronic::defaultsLoad();
```

Load your custom css or js file:
```$xslt
Metronic::loadLoad('custom',[
            'head'  => [
                'link'  => [
                    0 =>[
                        'href' => [
                            'custom',
                            'css',
                            'your-custom1.css'
                        ],
                        'rel'   => 'stylesheet',
                        'type'  => 'text/css'
                    ],
                    1 =>[
                        'href' => [
                            'plugins',
                            'custom',
                            'your-custom2.css'
                        ],
                        'rel'   => 'stylesheet',
                        'type'  => 'text/css'
                    ]
                ],
                'script' => [
                    0 => [
                        'src' => [
                            'js',
                            'custom1.js'
                        ],
                        'type' => 'text/javascript'
                    ]
                ],
            ],
            'body'  => [
                'script'=> [
                    0 => [
                        'src' => [
                            'plugins',
                            'custom-js',
                            'customize1.js'
                        ],
                        'type' => 'text/javascript'
                    ],
                    1 => [
                        'src' => [
                            'js',
                            'your script.js'
                        ],
                        'type' => 'text/javascript'
                    ]
                ]
            ]
        ]);
```