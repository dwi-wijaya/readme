<?php

use yii\db\Migration;

/**
 * Class m230103_070353_mst_loc
 */
class m230103_070353_mst_loc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("mst_loc", [
            'idloc'     => $this->string(30)->notNull(),
            'locname'   => $this->string(225),
            'locgroup'  => $this->string(45),
            'voltage'   => $this->string(45),
            'phone'     => $this->string(45),
            'lat'       => $this->float(),
            'lng'       => $this->float(),
            'subparent' => $this->string(125),
            'isactive'  => $this->integer(125),
            'ishidden'  => $this->integer(125),
        ]);
        $this->addPrimaryKey('mst_loc_pk', 'mst_loc','idloc');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230103_070353_mst_loc cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230103_070353_mst_loc cannot be reverted.\n";

        return false;
    }
    */
}
