<?php
return [
    'name'          =>  'Kalendarz',
    'description'   =>  'Kalendarz. Najbliższe nadchodzące wydarzenia wywołuje się funkcją szablonu {$incoming}.',
    'author'        =>  'pl',
    'version'       =>  '1.1',
    'compatibility'    =>    '1.3.*',                                // Compatibility with Batflat version
    'icon'          =>  'calendar',                                 // Icon from http://fontawesome.io/icons/

    'install'       =>  function () use ($core) {
	$core->db()->pdo()->exec("CREATE TABLE IF NOT EXISTS `calendar` (
            `id` integer NOT NULL PRIMARY KEY AUTOINCREMENT,
            `title` text NOT NULL,
            `color` text NOT NULL,
            `start` integer NOT NULL DEFAULT 0,
	    `stop` integer NOT NULL DEFAULT 0,
	    `user_id` integer NOT NULL DEFAULT 1
        )");
    },
    'uninstall'     =>  function () use ($core) {
    }
];
