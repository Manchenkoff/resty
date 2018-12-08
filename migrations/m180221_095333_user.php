<?php

use yii\db\Migration;

/**
 * Class m180221_095333_user
 */
class m180221_095333_user extends Migration
{
    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function up()
    {
        $this->createTable(
            '{{%user}}',
            [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull()->unique(),
                'name' => $this->string()->notNull(),
                'auth_key' => $this->string(32)->notNull(),
                'password' => $this->string()->notNull(),
                'email' => $this->string()->notNull()->unique(),

                'status' => $this->smallInteger()->notNull()->defaultValue(10),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ]
        );

        $this->createAdmin();
        $this->createManager();
        $this->createUser();
    }

    /**
     * Creates admin user
     *
     * @throws \yii\base\Exception
     */
    private function createAdmin()
    {
        $user = new \app\models\User();
        $user->scenario = \app\models\User::SCENARIO_CREATE;

        $user->username = 'admin';
        $user->name = 'Main User';
        $user->email = 'admin@example.com';
        $user->password = '123123#';

        $user->generateAuthkey();
        $user->activate();

        $user->save();
    }

    /**
     * Creates manager user
     *
     * @throws \yii\base\Exception
     */
    private function createManager()
    {
        $user = new \app\models\User();
        $user->scenario = \app\models\User::SCENARIO_CREATE;

        $user->username = 'manager';
        $user->name = 'Second User';
        $user->email = 'manager@example.com';
        $user->password = '123123#';

        $user->generateAuthkey();
        $user->activate();

        $user->save();
    }

    /**
     * Creates simple user
     *
     * @throws \yii\base\Exception
     */
    private function createUser()
    {
        $user = new \app\models\User();
        $user->scenario = \app\models\User::SCENARIO_CREATE;

        $user->username = 'user';
        $user->name = 'Simple User';
        $user->email = 'user@example.com';
        $user->password = '123123#';

        $user->generateAuthkey();
        $user->activate();

        $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
