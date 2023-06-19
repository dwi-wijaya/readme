<?php

use yii\db\Migration;

/**
 * Class m230113_042702_trs_map
 */
class m230113_042702_trs_map extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("trs_map", [
            'idtrsmap'                => $this->integer(),
            'idloc'                => $this->string(225),
            'ideqp'                => $this->string(225),
            'created'              => $this->date(),
            'tagname'              => $this->string(225),
            'value'                => $this->string(225),
            'loc_upt'              => $this->string(225),
            'loc_ultg'             => $this->string(225),
            'loc_gi'               => $this->string(225),
            'loc_bay'              => $this->string(225),
            'idmap'                => $this->string(225),
            'isgangguan'           => $this->integer(),
            'labelname'            => $this->string(225),
            'iduser'               => $this->string(225),
            'is_trigger'           => $this->boolean(),
        ]);
        $this->addPrimaryKey('trs_map_pk', 'trs_map','idtrsmap');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230113_042702_trs_map cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230113_042702_trs_map cannot be reverted.\n";

        return false;
    }
    */
}
