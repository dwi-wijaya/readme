<?php

use yii\db\Migration;

/**
 * Class m240212_021622_create_table_guides
 */
class m240212_021622_create_table_guides extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%guides}}', [
            'idguide' => $this->string()->notNull()->append('PRIMARY KEY'),
            'title' => $this->string()->notNull(),
            'slug' => $this->string(),
            'thumbnail' => $this->string(),
            'excerpt' => $this->string(),
            'pretext' => $this->string(),
            'description' => $this->string(),
            'author' => $this->string(64),
            'level' => $this->string(),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240212_021622_create_table_guides cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240212_021622_create_table_guides cannot be reverted.\n";

        return false;
    }
    */
}
