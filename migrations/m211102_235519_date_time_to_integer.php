<?php

use yii\db\Migration;

/**
 * Class m211102_235519_date_time_to_integer
 */
class m211102_235519_date_time_to_integer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('teachers_subject', 'lesson_date', 'Integer');//timestamp new_data_type
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211102_235519_date_time_to_integer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211102_235519_date_time_to_integer cannot be reverted.\n";

        return false;
    }
    */
}
