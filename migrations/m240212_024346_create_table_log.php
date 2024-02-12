<?php

use yii\db\Migration;

/**
 * Class m240212_024346_create_table_log
 */
class m240212_024346_create_table_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'idlog' => $this->string()->notNull()->append('PRIMARY KEY'),
            'act' => $this->string()->notNull(),
            'url' => $this->string(),
            'ip' => $this->string(),
            'user_id' => $this->string(),
            'data' => $this->text(),
            'old_data' => $this->text(),
            'created_at' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240212_024346_create_table_log cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240212_024346_create_table_log cannot be reverted.\n";

        return false;
    }
    */
}
