<?php

use yii\db\Migration;

/**
 * Class m180221_095516_rbac_index
 */
class m180221_095516_rbac_index extends Migration {
    public $column = 'user_id';
    public $index = 'auth_assignment_user_id_idx';

    /**
     * @throws yii\base\InvalidConfigException
     * @return mixed
     */
    protected function getAuthManager() {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof \yii\rbac\DbManager) {
            throw new \yii\base\InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }

    /**
     * {@inheritdoc}
     */
    public function up() {
        $authManager = $this->getAuthManager();
        $this->createIndex($this->index, $authManager->assignmentTable, $this->column);
    }

    /**
     * {@inheritdoc}
     */
    public function down() {
        $authManager = $this->getAuthManager();
        $this->dropIndex($this->index, $authManager->assignmentTable);
    }
}
