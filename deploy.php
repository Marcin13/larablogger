<?php

/*
|--------------------------------------------------------------------------
| Deployer
|--------------------------------------------------------------------------
|
| The deployment process requires Deployer package https://deployer.org
| To run this script use: USER=user PORT=port dep deploy [production]
| substituting 'user' with server's SSH user and 'port' with the port.
|
| @author: Piotr Palarz
 */

namespace Deployer;

define('USER', getenv('USER'));
define('PORT', getenv('PORT'));

if (count($_SERVER['argv']) > 1) {
    if (!USER || !PORT) {
        die("\nNo USER and/or PORT enviromental variables specified!\n\n");
    }
}

// https://github.com/deployphp/deployer/blob/master/recipe/laravel.php
require 'recipe/laravel.php';

set('http_user', 'www-data');
set('repository', '/opt/git/larablogger.git');
set('git_tty', true);

// Laravel writable dirs
set('writable_dirs', 'chown', [    ##dodałem chown
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'public'
]);

host('larablogger.pl')
    ->user(USER)
    ->port(PORT)
    ->set('deploy_path', '/var/www/larablogger.pl/html');

// desc('Override for the original command to skip it');
// task('artisan:cache:clear', function () {
//     writeln('Skipping...');
// });

after('artisan:config:cache', 'artisan:queue:restart');
before('deploy:symlink', 'artisan:migrate');
after('deploy:failed', 'deploy:unlock');
