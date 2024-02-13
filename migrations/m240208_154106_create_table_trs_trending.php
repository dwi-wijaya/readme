<?php

use yii\db\Migration;

class m240208_154106_create_table_trs_trending extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%trs_trending}}',
            [
                'idtrend' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'item_id' => $this->string(100),
                'item_type' => $this->string(16),
                'iduser' => $this->string(100),
                'created_at' => $this->date(),
                'updated_at' => $this->date(),
                'liked' => $this->string(100),
            ],
            $tableOptions
        );

        $this->createIndex('NewTable_idarticlce_IDX', '{{%trs_trending}}', ['idarticle']);
        $this->createIndex('NewTable_iduser_IDX', '{{%trs_trending}}', ['iduser']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%trs_trending}}');
    }
}
