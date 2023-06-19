<?php

use yii\db\Migration;

/**
 * Class m230202_063651_ADD_COLUMN_REASON_TRSSCH
 */
class m230202_063651_ADD_COLUMN_REASON_TRSSCH extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('TRS_SCH','REASON', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230202_063651_ADD_COLUMN_REASON_TRSSCH cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230202_063651_ADD_COLUMN_REASON_TRSSCH cannot be reverted.\n";

        return false;
    }
    */
}
