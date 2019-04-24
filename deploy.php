<?php

namespace Deployer;

/** @noinspection PhpIncludeInspection */
require 'recipe/laravel.php';
require 'recipe/yarn.php';

task('artisan:config:clear', function () {
    run('{{bin/php}} {{deploy_path}}/current/artisan config:clear');
})->desc('Clear config');

task('artisan:queue:restart', function () {
    run('{{bin/php}} {{deploy_path}}/current/artisan queue:restart');
})->desc('Execute artisan queue:restart');

task('npm:prod', function () {
    run('cd {{ release_path }} && npm run prod');
});

desc('Cache routes');
task('artisan:route:cache', function () {
    run('{{bin/php}} {{release_path}}/artisan route:cache');
});

task('initialize', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:config:clear',
    'artisan:route:cache',
    'yarn:install',
    'yarn:prod',
    'artisan:migrate',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'artisan:queue:restart',
]);

// Configuration

set('repository', 'git@github.com:nicklasos/gameconsoles.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', []);
add('shared_dirs', ['storage']);
add('writable_dirs', []);
set('allow_anonymous_stats', false);
set('keep_releases', 20);

// Hosts

host('167.99.4.99')
    ->stage('production')
    ->set('branch', 'master')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/gameconsoles');

// Tasks
desc('Restart PHP-FPM service');
task('deploy:php:reload', function () {
    run('for s in $( service --status-all | grep -o "\bphp.*fpm\b" ); do sudo service $s reload; done');
});

desc('Build assets');
task('yarn:prod', function () {
    run('cd {{release_path}} && {{bin/yarn}} run production');
});

after('deploy:symlink', 'deploy:php:reload');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

