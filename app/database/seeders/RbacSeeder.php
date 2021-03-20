<?php

declare(strict_types=1);

namespace app\database\seeders;

use Exception;
use manchenkov\yii\console\Command;
use yii\base\Action;
use yii\rbac\ManagerInterface;

/**
 * Class RbacSeeder
 * @package app\database\seeders
 *
 * @property-read Command $controller
 */
final class RbacSeeder extends Action
{
    /**
     * Creates basic RBAC configuration
     * @throws Exception
     */
    public function run(): void
    {
        $rbac = app()->authManager;

        $this->baseRoles($rbac);

        $this->controller->info("RBAC initialized successfully");
    }

    /**
     * @param ManagerInterface $manager
     *
     * @throws \yii\base\Exception
     * @throws Exception
     */
    public function baseRoles(ManagerInterface $manager): void
    {
        $roleUser = $manager->createRole('user');
        $manager->add($roleUser);

        $roleManager = $manager->createRole('manager');
        $manager->add($roleManager);
        $manager->addChild($roleManager, $roleUser);

        $roleAdmin = $manager->createRole('admin');
        $manager->add($roleAdmin);
        $manager->addChild($roleAdmin, $roleManager);

        $manager->assign($roleAdmin, 1);
        $manager->assign($roleManager, 2);
        $manager->assign($roleUser, 3);
    }
}
