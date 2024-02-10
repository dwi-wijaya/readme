<?php

use yii\db\Migration;

class m240208_154055_create_table_assets extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%assets}}',
            [
                'idassets' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'asset_name' => $this->string(100),
                'created_at' => $this->date(),
                'iduser' => $this->string(64),
            ],
            $tableOptions
        );

        $this->createIndex('assets_asset_name_IDX', '{{%assets}}', ['asset_name']);
        $this->createIndex('assets_iduser_IDX', '{{%assets}}', ['iduser']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%assets}}');
    }
}
