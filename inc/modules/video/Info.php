<?php

return [
    'name'          =>  'Filmy',
    'description'   =>  'Filmy umieszczane w serwisie youtube.com na kanale https://www.youtube.com/channel/UCuTjdDJ7qWuKVY_MMD64t0w',
    'author'        =>  'pl',
    'version'       =>  '1.0',
    'compatibility'    =>    '1.3.*',                                // Compatibility with Batflat version
    'icon'          =>  'film',                                 // Icon from http://fontawesome.io/icons/


    'install'       =>  function () use ($core) {
	$core->db()->pdo()->exec("CREATE TABLE IF NOT EXISTS `videos` (
            `id` integer NOT NULL PRIMARY KEY AUTOINCREMENT,
            `title` text NOT NULL,
            `videoid` text NOT NULL
        )");
    },
    'uninstall'     =>  function () use ($core) {
    }
];
