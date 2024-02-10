<?php

use yii\db\Migration;

class m240208_154058_create_table_mst_menu extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mst_menu}}',
            [
                'idmenu' => $this->string(100)->notNull()->append('PRIMARY KEY'),
                'name' => $this->string(100),
                'route' => $this->string(100),
                'parent' => $this->string(100),
                'order' => $this->integer(8),
                'icon' => $this->string(100),
                'data' => $this->string(100),
                'type' => $this->string(100),
                'is_dropdown' => $this->boolean()
            ],
            $tableOptions
        );
        $data = [
            [uniqid(), 'Home', 'site/index', '', '1', 'house', '', '', '0'],
            [uniqid(), 'Explore', 'site/explore', '', '2', 'search', '', '', '0'],
            [uniqid(), 'RBAC', '', '', '11', 'sliders', '', '1', '0'],
            [uniqid(), 'Menu', '/menu/index', 'RBAC', '', 'lists', '', '1', '1'],
            [uniqid(), 'Users', '/users/index', 'RBAC', '', 'user', '', '1', '1'],
            [uniqid(), 'Role', '/role/index', 'RBAC', '', 'user-tag', '', '1', '1'],
            [uniqid(), 'Routes', '/route/index', 'RBAC', '', 'link', '', '1', '1'],
            [uniqid(), 'Permission', '/permission/index', 'RBAC', '', '', '', '1', '1'],
            [uniqid(), 'Dashboard', '/dashboard/index', '', '3', 'house-user', '', '1', '0'],
            [uniqid(), 'Master', '', '', '10', 'database', '', '1', '0'],
            [uniqid(), 'Category', '/category/index', 'Master', '1', 'lists', '', '1', '1'],
            [uniqid(), 'Tag', '/tag/index', 'Master', '2', 'tags', '', '1', '1'],
            [uniqid(), 'Reason', '/reason/index', 'Master', '4', '', '', '1', '1'],
            [uniqid(), 'Users Acticity', '', '', '9', 'chart-line', '', '1', '0'],
            [uniqid(), 'Trending', '/trending/index', 'Users Acticity', '1', '', '', '1', '1'],
            [uniqid(), 'Like', '/like/index', 'Users Acticity', '2', '', '', '1', '1'],
            [uniqid(), 'Bookmark', '/bookmark/index', 'Users Acticity', '3', '', '', '1', '1'],
            [uniqid(), 'Follow', '/follow/index', 'Users Acticity', '4', '', '', '1', '1'],
            [uniqid(), 'My Articles', '', '', '5', 'book', '', '1', '0'],
            [uniqid(), 'Articles', '/article/index', 'My Articles', '1', '', '', '1', '1'],
            [uniqid(), 'Archives Articles', '/article/list-article', 'My Articles', '3', '', '', '1', '1'],
            [uniqid(), 'Submission', '', '', '7', 'list-check', '', '1', '0'],
            [uniqid(), 'Approval', '/article/submission', 'Submission', '1', '', '', '1', '1'],
        ];
        $this->batchInsert('{{%mst_menu}}', ['idmenu', 'name', 'route', 'parent', 'order', 'icon', 'data', 'type', 'is_dropdown'], $data);
    }

    public function safeDown()
    {
        $this->dropTable('{{%mst_menu}}');
    }
}
