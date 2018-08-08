<?php

use yii\db\Migration;

/**
 * Class m180808_175329_user
 */
class m180808_175329_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE \"user\" (
              id BIGSERIAL PRIMARY KEY NOT NULL ,
              first_name TEXT NOT NULL CHECK (length(first_name) <= 255),
              second_name TEXT NOT NULL CHECK (length(second_name) <= 255),
              patronymic TEXT CHECK (length(patronymic) <= 255),
              mail TEXT NOT NULL UNIQUE CHECK (length(mail) <= 255)        
            );
        ");

        $this->execute("
            CREATE TABLE individual (
              id BIGSERIAL PRIMARY KEY NOT NULL ,
              user_id BIGINT NOT NULL REFERENCES \"user\"(id),
              inn TEXT UNIQUE CHECK (length(inn) = 12)                       
            );
        ");

        $this->execute("
            CREATE TABLE legal (
              id BIGSERIAL PRIMARY KEY NOT NULL ,
              user_id BIGINT NOT NULL REFERENCES \"user\"(id),
              company_name TEXT NOT NULL CHECK (length(company_name) <= 255),
              inn TEXT NOT NULL UNIQUE CHECK (length(inn) = 12)                       
            );
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("DROP TABLE legal;");
        $this->execute("DROP TABLE individual;");
        $this->execute("DROP TABLE \"user\";");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180808_175329_user cannot be reverted.\n";

        return false;
    }
    */
}
