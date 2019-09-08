<?php

use yii\db\Migration;

/**
 * Class m190828_184721_posts
 */
class m190828_184721_posts extends Migration
{
    /**
     * Setup migration
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_user_post',
            'post', 'user_id',
            'user', 'id',
            'cascade'
        );
    }

    /**
     * Rollback migration
     * @return bool|void
     */
    public function down()
    {
        $this->dropForeignKey('fk_user_post', 'post');
        $this->dropTable('post');
    }
}
