<?php

use yii\db\Migration;

class m240208_154100_create_table_mst_tag extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mst_tag}}',
            [
                'idtag' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'tagname' => $this->string(100),
                'created_at' => $this->string(100),
                'updated_at' => $this->string(100),
                'slug' => $this->string(100),
            ],
            $tableOptions
        );
        
        $tags = [
            [uniqid(), 'PHP', date('Y-m-d'), date('Y-m-d'), 'php'],
            [uniqid(), 'JavaScript', date('Y-m-d'), date('Y-m-d'), 'javascript'],
            [uniqid(), 'HTML', date('Y-m-d'), date('Y-m-d'), 'html'],
            [uniqid(), 'CSS', date('Y-m-d'), date('Y-m-d'), 'css'],
            // Add more tags as needed
        ];

        $this->batchInsert('mst_tag', ['idtag', 'tagname', 'created_at', 'updated_at', 'slug'], $tags);
    }

    public function safeDown()
    {
        $this->dropTable('{{%mst_tag}}');
    }
}
