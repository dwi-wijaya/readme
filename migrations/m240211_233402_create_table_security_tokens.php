<?php

use yii\db\Migration;

/**
 * Class m240211_233402_create_table_reset_password_tokens
 */
class m240211_233402_create_table_security_tokens extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('security_tokens', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string(64)->notNull(),
            'token' => $this->string()->notNull(),
            'expires_at' => $this->dateTime()->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->createIndex('tokens_user_id_IDX', '{{%security_tokens}}', ['user_id']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240211_233402_create_table_reset_password_tokens cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240211_233402_create_table_reset_password_tokens cannot be reverted.\n";

        return false;
    }
    */
}
