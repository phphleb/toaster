<?php
if (file_exists(__DIR__ . '/database-local.php')) { return (require __DIR__ . '/database-local.php');}

return [
    'base.db.type' => 'mariadb',

    'db.settings.list' => [

        'mariadb' => [
            'mysql:host=db',
            'port=3306',
            'dbname=MYSQL_DATABASE',
            'charset=utf8',
            'user' => 'MYSQL_USER',
            'pass' => 'MYSQL_PASSWORD',
        ],
    ]
];