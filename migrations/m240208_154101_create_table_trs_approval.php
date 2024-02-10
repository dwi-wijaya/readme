<?php

use yii\db\Migration;

class m240208_154101_create_table_trs_approval extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%trs_approval}}',
            [
                'idapproval' => $this->string(100),
                'idarticle' => $this->string(100),
                'status' => $this->string(100),
                'created_at' => $this->date(),
                'note' => $this->string(100),
                'idreason' => $this->string(100),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%trs_approval}}');
    }
}
