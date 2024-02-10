<?php

use yii\db\Migration;

class m240208_154104_create_table_trs_like extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%trs_like}}',
            [
                'idlike' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'idarticle' => $this->string(100),
                'is_like' => $this->boolean(),
                'iduser' => $this->string(64),
                'created_at' => $this->date(),
            ],
            $tableOptions
        );

        $this->createIndex('trs_like_idarticle_IDX', '{{%trs_like}}', ['idarticle']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%trs_like}}');
    }
}
