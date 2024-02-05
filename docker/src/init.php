<?php

const DB_ENV_PARAMS = ['MYSQL_DATABASE', 'MYSQL_USER', 'MYSQL_PASSWORD'];

if (count(scandir('/hleb')) == 2) {
    exec('composer create-project phphleb/hleb /hleb');

    $config = file_get_contents('/src/database.php');
    foreach (DB_ENV_PARAMS as $envName) {
        $config = str_replace($envName, getenv($envName), $config);
    }
    file_put_contents('/hleb/config/database.php', $config);
    $config = str_replace('database-local', 'database-server', $config);
    file_put_contents('/hleb/config/database-local.php', $config);
    unlink('/src/database.php');

    rename('/src/.php-cs-fixer.php', '/hleb/.php-cs-fixer.php');
    exec('/root/.composer/vendor/bin/php-cs-fixer fix /hleb');
    exec('sh /root/www-data.sh');
}
