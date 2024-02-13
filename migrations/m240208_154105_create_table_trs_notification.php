<?php

use yii\db\Migration;

class m240208_154105_create_table_trs_notification extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%trs_notification}}',
            [
                'idnotification' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'sender_id' => $this->string(64),
                'recipient_id' => $this->string(64),
                'type' => $this->string(100),
                'idarticle' => $this->string(100),
                'created_at' => $this->timestamp(),
            ],
            $tableOptions
        );

        $this->createIndex('trs_notification_idarticle_IDX', '{{%trs_notification}}', ['idarticle']);
        $this->createIndex('trs_notification_recipient_id_IDX', '{{%trs_notification}}', ['recipient_id']);
        $this->createIndex('trs_notification_sender_id_IDX', '{{%trs_notification}}', ['sender_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%trs_notification}}');
    }
}
