<?php

use yii\db\Migration;

/**
 * Class m230113_042649_mst_map
 */
class m230113_042649_mst_map extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("mst_map", [
            'idmap'                => $this->string(225)->notNull(),
            'labelname'            => $this->string(225),
            'tagname'              => $this->string(225),
            'sourcetable'          => $this->string(225),
            'idloc'                => $this->string(225),
            'idrelay'              => $this->string(225),
            'isgangguan'           => $this->integer(),
            'loc_upt'              => $this->string(225),
            'loc_ultg'             => $this->string(225),
            'loc_gi'               => $this->string(225),
            'loc_bay'              => $this->string(225),
            'value'                => $this->string(225),
            'isapproved'           => $this->boolean(),
            'iduser'               => $this->string(225),
            'status'               => $this->integer(225),
            'date_approvedspvgi'   => $this->date(),
            'date_approvedmanultg' => $this->date(),
            'user_approvedspvgi'   => $this->string(225),
            'user_approvedmanultg' => $this->string(225),
            'date_reject'          => $this->date(),
            'user_reject'          => $this->string(225),
            'created'              => $this->date(),
            'is_trigger'           => $this->boolean(),
        ]);
        $this->addPrimaryKey('mst_map_pk', 'mst_map','idmap');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230113_042649_trs_map cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230113_042649_mst_map cannot be reverted.\n";

        return false;
    }
    */
}
