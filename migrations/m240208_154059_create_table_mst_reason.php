<?php

use yii\db\Migration;

class m240208_154059_create_table_mst_reason extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mst_reason}}',
            [
                'idreason' => $this->string(100)->notNull(),
                'reason' => $this->string(100),
                'flag' => $this->string(100),
            ],
            $tableOptions
        );
        
        $rows = [
            [uniqid(), 'Incomplete Content', 'REJECT'],
            [uniqid(), 'Plagiarism', 'REJECT'],
            // Add more rows of data as needed
        ];

        $this->batchInsert('mst_reason', ['idreason', 'reason', 'flag'], $rows);

        $this->createIndex('mst_reason_flag_IDX', '{{%mst_reason}}', ['flag']);
        $this->createIndex('mst_reason_reason_IDX', '{{%mst_reason}}', ['reason']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%mst_reason}}');
    }
}
