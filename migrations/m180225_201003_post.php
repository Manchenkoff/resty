<?php

use yii\db\Migration;

/**
 * Class m180225_201003_post
 */
class m180225_201003_post extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
            'author_id' => $this->integer(),
        ]);

        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey(
                'post_author',

                '{{%post}}',
                'author_id',

                '{{%user}}',
                'id'
            );
        }

        $this->loadSampleData();
    }

    public function loadSampleData()
    {
        // First post
        $post_item = new app\models\Post();

        $post_item->title = "First post";
        $post_item->body = "Some post content information";
        $post_item->author_id = 2; // manager

        $post_item->save();

        // Second post
        $post_item = new app\models\Post();

        $post_item->title = "Second post";
        $post_item->body = "Lorem ipsum is more interesting text";
        $post_item->author_id = 3; // user

        $post_item->save();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%post}}');
    }
}
