<?php

use yii\db\Migration;

class m240208_154054_create_table_article extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%article}}',
            [
                'idarticle' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'title' => $this->string(125),
                'slug' => $this->string(125),
                'subtitle' => $this->string(255),
                'created_at' => $this->date(),
                'tag' => $this->string(100),
                'idcat' => $this->string(100),
                'content' => $this->text(),
                'author_id' => $this->string(64),
                'thumbnail' => $this->string(100),
                'cetegory' => $this->string(100),
                'updated_at' => $this->date(),
                'status' => $this->string(100),
                'approved_by' => $this->string(100),
                'approved_at' => $this->date(),
            ],
            $tableOptions
        );

        $this->createIndex('article_author_id_IDX', '{{%article}}', ['author_id']);
        $this->createIndex('article_cetegory_IDX', '{{%article}}', ['cetegory']);
        $this->createIndex('article_idcat_IDX', '{{%article}}', ['idcat']);
        $this->createIndex('article_status_IDX', '{{%article}}', ['status']);
        $this->createIndex('article_tag_IDX', '{{%article}}', ['tag']);
        $this->createIndex('article_title_IDX', '{{%article}}', ['title']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
