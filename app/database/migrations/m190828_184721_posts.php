<?php /** @noinspection ALL */

declare(strict_types=1);

use yii\db\Migration;

class m190828_184721_posts extends Migration
{
    public function up(): void
    {
        $this->createTable(
            'post',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
                'body' => $this->text(),
                'user_id' => $this->integer(),
            ]
        );

        $this->addForeignKey(
            'fk_user_post',
            'post',
            'user_id',
            'user',
            'id',
            'cascade'
        );
    }

    public function down(): void
    {
        $this->dropForeignKey('fk_user_post', 'post');
        $this->dropTable('post');
    }
}
