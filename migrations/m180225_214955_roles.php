<?php

use yii\db\Migration;

/**
 * Class m180225_214955_roles
 */
class m180225_214955_roles extends Migration
{

    public function up()
    {
        $auth = Yii::$app->getAuthManager();

        try {
            // Role: user
            $user = $auth->createRole('user');
            $auth->add($user);

            // Role: manager
            $manager = $auth->createRole('manager');
            $auth->add($manager);
            $auth->addChild($manager, $user);

            // Role: admin
            $admin = $auth->createRole('admin');
            $auth->add($admin);
            $auth->addChild($admin, $manager);

            // Assign permissions
            $auth->assign($admin, 1);
            $auth->assign($manager, 2);
            $auth->assign($user, 3);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

}
