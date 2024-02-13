<?php

use yii\db\Migration;

class m240208_154102_create_table_trs_bookmark extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%trs_bookmark}}',
            [
                'idbookmark' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'idarticle' => $this->string(100),
                'iduser' => $this->string(64),
                'created_at' => $this->timestamp(),
            ],
            $tableOptions
        );

        $this->createIndex('trs_bookmark_idarticle_IDX', '{{%trs_bookmark}}', ['idarticle']);
        $this->createIndex('trs_bookmark_iduser_IDX', '{{%trs_bookmark}}', ['iduser']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%trs_bookmark}}');
    }
}
