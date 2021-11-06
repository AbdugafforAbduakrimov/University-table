<?php

use yii\db\Migration;

/**
 * Class m211101_045533_first_tables
 */
class m211101_045533_first_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(100)->notNull(),
            'phone_number' => $this->string(50),
            'status' => $this->smallInteger(),
            'created_date' => $this->timestamp(),
        ]);


        $this->createTable('teachers', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(100)->notNull(),
            'phone_number' => $this->string(50),
            'status' => $this->smallInteger(),
            'created_date' => $this->timestamp(),
        ]);

        $this->createTable('subjects', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'status' => $this->smallInteger(),
        ]);


        $this->createTable('rooms', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'number' => $this->string(50),
            'status' => $this->smallInteger(),
        ]);

        $this->createTable('groups', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            // 'phone_number' => $this->string(50),
            'status' => $this->smallInteger(),
            'created_date' => $this->timestamp(),
        ]);

        $this->createTable('teachers_subject', [
            'id' => $this->primaryKey(),
            'teachers_id' => $this->smallInteger(),
            'subjects_id' => $this->smallInteger(),
            'rooms_id' => $this->smallInteger(),
            'group_id' => $this->smallInteger(),
            'pair' => $this->smallInteger(),
            'lesson_date' => $this->timestamp(),
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211101_045533_first_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211101_045533_first_tables cannot be reverted.\n";

        return false;
    }
    */
}
