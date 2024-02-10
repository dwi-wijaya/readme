<?php

use yii\db\Migration;

class m240208_154057_create_table_mst_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mst_category}}',
            [
                'idcat' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'name' => $this->string(100),
                'slug' => $this->string(100),
                'icon' => $this->string(100),
                'color' => $this->string(100),
                'description' => $this->string(450),
                'created_at' => $this->date(),
                'updated_at' => $this->date(),
            ],
            $tableOptions
        );

        $categories = [
            [uniqid(), 'Programming', 'programming', date('Y-m-d'), date('Y-m-d'), 'mobile', 'red', "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, "],
            [uniqid(), 'Web Development', 'web-development', date('Y-m-d'), date('Y-m-d'), 'mobile', 'red', "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, "],
            [uniqid(), 'Software Engineering', 'software-engineering', date('Y-m-d'), date('Y-m-d'), 'mobile', 'red', "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, "],
            [uniqid(), 'Database Management', 'database-management', date('Y-m-d'), date('Y-m-d'), 'mobile', 'red', "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, "],
            // Add more categories as needed
        ];

        $this->batchInsert('mst_category', ['idcat', 'name', 'slug', 'created_at', 'updated_at', 'icon', 'color', 'description'], $categories);

        $this->createIndex('mst_category_slug_IDX', '{{%mst_category}}', ['slug']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%mst_category}}');
    }
}
