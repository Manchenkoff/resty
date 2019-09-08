<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

namespace Deployer;

require __DIR__ . '/config/deploy/params.php';
require __DIR__ . '/config/deploy/tasks.php';

/**
 * Deploy common API
 *
 * dep [task] [options] [stage]
 *
 * dep deploy production
 * dep deploy stage
 * dep deploy --branch=master
 * dep deploy --parallel
 * dep deploy --file=file.php
 */

// Use 'dep commit' - first project initialization (no vendors & release symlink)
task('commit', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:env',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:clear_paths',
    'deploy:unlock',
    'cleanup',
    'success',
])->desc('Initial project upload');

// Use 'dep deploy' - deploy project release
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'supervisor:stop',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'yii:migrate',
    'deploy:symlink',
    'deploy:unlock',
    'supervisor:start',
    'cleanup',
    'success',
])->desc('Deploy your project');

// If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');