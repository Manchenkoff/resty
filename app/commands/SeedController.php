<?php

declare(strict_types=1);

namespace app\commands;

use app\database\seeders\PostSeeder;
use app\database\seeders\RbacSeeder;
use app\database\seeders\UserSeeder;
use manchenkov\yii\console\Command;

/**
 * Seeder for loading fake or prepared data into a database
 * @package App\Commands
 */
class SeedController extends Command
{
    /**
     * List of actions which provides data to seeding
     * @return array
     */
    public function actions(): array
    {
        return [
            // application seeders
            'user' => UserSeeder::class,
            'rbac' => RbacSeeder::class,
            'post' => PostSeeder::class,
        ];
    }
}