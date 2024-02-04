<?php

if (count(scandir('/hleb')) == 2) {
    exec('composer create-project phphleb/hleb /hleb');

    $config = file_get_contents('/root/database.php');
    foreach (['MYSQL_DATABASE', 'MYSQL_USER', 'MYSQL_PASSWORD'] as $envName) {
        $config = str_replace($envName, getenv($envName), $config);
    }
    file_put_contents('/hleb/config/database.php', $config);
    unlink('/root/database.php');

    rename('/root/database.php', '/hleb/config/database.php');
    rename('/root/.php-cs-fixer.php', '/hleb/.php-cs-fixer.php');
    exec('/root/.composer/vendor/bin/php-cs-fixer fix /hleb');
    exec('sh /root/www-data.sh');
} else {
    unlink('/root/database.php');
    unlink('/root/.php-cs-fixer.php');
}
