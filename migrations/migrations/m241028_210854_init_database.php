<?php

use yii\db\Migration;
use app\enums\UserStatusEnum;
/**
 * Class m241028_210854_init_database
 */
class m241028_210854_init_database extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%short_links}}', [
            'token' => $this->string(5)->notNull()->unique(),
            'original_url' => $this->string(2048)->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk_short_links', '{{%short_links}}', 'token');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey('pk_short_links', '{{%short_links}}');

        $this->dropTable('{{%short_links}}');
    }
}
