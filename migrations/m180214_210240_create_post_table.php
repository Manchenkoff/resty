<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m180214_210240_create_post_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
        ]);

        $this->loadSampleData();
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('{{%post}}');
    }

    public function loadSampleData() {
        // First post
        $post_item = new resty\models\Post();

        $post_item->title = "First post";
        $post_item->body = "Some post content information";

        $post_item->save();

        // Second post
        $post_item = new resty\models\Post();

        $post_item->title = "Second post";
        $post_item->body = "Lorem ipsum is more interesting text";

        $post_item->save();
    }
}
