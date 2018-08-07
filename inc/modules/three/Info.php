<?php
return [
    'name'          =>  'Ostatni post',
    'description'   =>  'Pokazuje ostatnie posty w formie tabliczek. Wywołanie poprzez funkcję szablonu {$three}',
    'author'        =>  'pl',
    'version'       =>  '1.0',
    'compatibility'    =>    '1.3.*',                                // Compatibility with Batflat version
    'icon'          =>  'th',                                 // Icon from http://fontawesome.io/icons/

    // Registering page for possible use as a homepage
    'pages'            =>  ['Sample Page' => 'sample'],

    'install'       =>  function () use ($core) {
    },
    'uninstall'     =>  function () use ($core) {
    }
];
