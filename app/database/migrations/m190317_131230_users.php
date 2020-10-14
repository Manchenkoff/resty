<?php

declare(strict_types=1);

use yii\db\Migration;

class m190317_131230_users extends Migration
{
    public function up(): void
    {
        $this->createTable(
            'user',
            [
                'id' => $this->primaryKey(),

                // base data (auth)
                'email' => $this->string()->unique()->notNull(),
                'password_hash' => $this->string()->notNull(),
                'token' => $this->string(32)->unique(),
                'is_active' => $this->boolean()->defaultValue(false),

                // information
                'first_name' => $this->string()->notNull(),
                'last_name' => $this->string()->notNull(),

                // timestamps
                'created_at' => $this->integer(),
                'updated_at' => $this->integer(),

                // soft delete attribute
                'deleted_at' => $this->integer(),

                // JSON additional data attribute
                'data' => $this->json(),
            ]
        );
    }

    public function down(): void
    {
        $this->dropTable('user');
    }
}
