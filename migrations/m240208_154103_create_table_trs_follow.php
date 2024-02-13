<?php

use yii\db\Migration;

class m240208_154103_create_table_trs_follow extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%trs_follow}}',
            [
                'idfollow' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'author_id' => $this->string(100),
                'user_id' => $this->string(54),
                'created_at' => $this->timestamp(),
            ],
            $tableOptions
        );

        $this->createIndex('trs_follow_author_id_IDX', '{{%trs_follow}}', ['author_id']);
        $this->createIndex('trs_follow_user_id_IDX', '{{%trs_follow}}', ['user_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%trs_follow}}');
    }
}
