<?php

use yii\db\Migration;

class m240208_154107_create_table_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%user}}',
            [
                'username' => $this->string(64)->notNull()->append('PRIMARY KEY'),
                'first_name' => $this->string(100),
                'last_name' => $this->string(100),
                'password' => $this->string(100),
                'email' => $this->string(100),
                'profile_picture' => $this->string(100),
                'bio' => $this->string(255),
                'status' => $this->string(8),
                'authKey' => $this->string(100),
                'created_at' => $this->timestamp(),
                'updated_at' => $this->timestamp(),
                'lastlogin' => $this->timestamp()
            ],
            $tableOptions
        );

        $users = [
            ['admin', 'Admin', 'User', Yii::$app->security->generatePasswordHash(md5('admin')), 'user.png', 'Admin bio', 'admin_auth_key', date('Y-m-d'), date('Y-m-d')],
            ['author', 'Author', 'User', Yii::$app->security->generatePasswordHash(md5('author')), 'user.png', 'Author bio', 'author_auth_key', date('Y-m-d'), date('Y-m-d')],
            ['editor', 'Editor', 'User', Yii::$app->security->generatePasswordHash(md5('editor')), 'user.png', 'Editor bio', 'editor_auth_key', date('Y-m-d'), date('Y-m-d')],
            ['subscriber', 'Subscriber', 'User', Yii::$app->security->generatePasswordHash(md5('subscriber')), 'user.png', 'Subscriber bio', 'subscriber_auth_key', date('Y-m-d'), date('Y-m-d')],
            // Add more users as needed
        ];

        $this->batchInsert('user', ['username', 'first_name', 'last_name', 'password', 'profile_picture', 'bio', 'authKey', 'created_at', 'updated_at'], $users);
    
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
