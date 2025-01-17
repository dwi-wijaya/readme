<?php

use yii\db\Migration;

class m240208_154109_create_table_auth_item_child extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%auth_item_child}}',
            [
                'parent' => $this->string(64)->notNull(),
                'child' => $this->string(64)->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%auth_item_child}}', ['parent', 'child']);

        $this->createIndex('child', '{{%auth_item_child}}', ['child']);

        $this->addForeignKey(
            'auth_item_child_ibfk_1',
            '{{%auth_item_child}}',
            ['parent'],
            '{{%auth_item}}',
            ['name'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'auth_item_child_ibfk_2',
            '{{%auth_item_child}}',
            ['child'],
            '{{%auth_item}}',
            ['name'],
            'CASCADE',
            'CASCADE'
        );

        $roles = [
            ['SUPER ADMIN', 1],
            ['AUTHOR', 1],
            ['EDITOR', 1],
            ['SUBSCRIBER', 1],
            // Add more roles as needed
        ];

        $this->batchInsert('auth_item', ['name', 'type'], $roles);
        
    }

    public function safeDown()
    {
        $this->dropTable('{{%auth_item_child}}');
    }
}
