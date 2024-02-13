<?php

use yii\db\Migration;

/**
 * Class m240212_021632_create_table_guide_article
 */
class m240212_021632_create_table_guide_list extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%guide_list}}', [
            'idguide_list' => $this->string()->notNull()->append('PRIMARY KEY'),
            'idarticle' => $this->string()->notNull(),
            'order' => $this->string(),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240212_021632_create_table_guide_article cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240212_021632_create_table_guide_article cannot be reverted.\n";

        return false;
    }
    */
}
