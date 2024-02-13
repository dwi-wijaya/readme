<?php

use yii\db\Migration;

/**
 * Class m240213_175945_create_table_user_progres
 */
class m240213_175945_create_table_user_progres extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_progress}}', [
            'iduser_progress' => $this->string()->notNull()->append('PRIMARY KEY'),
            'user_id' => $this->string(64)->notNull(),
            'idguide' => $this->string()->notNull(),
            'idguide_list' => $this->string()->notNull(),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240213_175945_create_table_user_progres cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240213_175945_create_table_user_progres cannot be reverted.\n";

        return false;
    }
    */
}
