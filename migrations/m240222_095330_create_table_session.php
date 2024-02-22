<?php

use yii\db\Migration;

/**
 * Class m240222_095330_create_table_session
 */
class m240222_095330_create_table_session extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('session', [
            'id' => $this->char(40)->notNull(),
            'expire' => $this->integer(),
            'data' => $this->binary(),
            'user_id' => $this->integer()
        ]);
        
        $this->addPrimaryKey('session_pk', 'session', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240222_095330_create_table_session cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240222_095330_create_table_session cannot be reverted.\n";

        return false;
    }
    */
}
