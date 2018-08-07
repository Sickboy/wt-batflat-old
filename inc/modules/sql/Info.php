<?php
return [
    'name'          =>  'Zapytanie SQL',
    'description'   =>  'Wykonuje zapytanie SQL na bazie - zapytania bez zwracania wartości (INSERT, DROP, DELETE, UPDATE)',
    'author'        =>  'pl',
    'version'       =>  '0.9',
    'compatibility'    =>    '1.3.*',                                // Compatibility with Batflat version
    'icon'          =>  'database',                                 // Icon from http://fontawesome.io/icons/

    'pages'            =>  ['Sample Page' => 'sample'],

    'install'       =>  function () use ($core) {
    },
    'uninstall'     =>  function () use ($core) {
    }
];
