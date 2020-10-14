<?php

namespace Deployer;

$root = dirname(dirname(__DIR__));

// Include configuration files
require $root . '/vendor/autoload.php';
require $root . '/vendor/deployer/deployer/recipe/common.php';

// Custom dependencies
use Dotenv\Dotenv;

// Load environments configuration
$env = Dotenv::create($root);
$env->load();

/**
 * Project settings
 */
set('repository', env('DEPLOY_REPOSITORY'));
set('hostname', env('DEPLOY_HOST'));
set('user', env('DEPLOY_USER'));

/**
 * Hosts
 */
host('production')
    ->hostname(get('hostname'))
    ->user(get('user'))
    ->identityFile('~/.ssh/id_rsa')
    ->port(22)
    ->set('deploy_path', env('DEPLOY_PATH'))
    ->set('public_path', env('DEPLOY_PUBLIC_PATH'));

/**
 * Deployment settings
 */
set('allow_anonymous_stats', false);
set('ssh_multiplexing', true);
set('keep_releases', 2);

/**
 * Shared files/dirs between deploys
 */
set(
    'shared_files',
    [
        '.env',
    ]
);

set(
    'shared_dirs',
    [
        'runtime',
    ]
);

/**
 * Writable dirs by web server
 */
set(
    'writable_dirs',
    [
        'runtime',
    ]
);