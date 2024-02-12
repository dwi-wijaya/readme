<?php

use yii\db\Migration;

/**
 * Class m240211_124728_create_table_otp_codes
 */
class m240211_124728_create_table_otp_codes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('otp_codes', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string(64)->notNull(),
            'otp_code' => $this->string(6)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'expired_at' => $this->timestamp()->null(),
        ]);
        
        $this->createIndex('otp_user_id_IDX', '{{%otp_codes}}', ['user_id']);
        // Add foreign key constraint
        // $this->addForeignKey(
        //     'fk-otp_codes-user_id',
        //     'otp_codes',
        //     'user_id',
        //     'user', // Replace with the actual user table name
        //     'username',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240211_124728_create_table_otp_codes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240211_124728_create_table_otp_codes cannot be reverted.\n";

        return false;
    }
    */
}
