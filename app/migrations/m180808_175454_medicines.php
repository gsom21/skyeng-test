<?php

use yii\db\Migration;

/**
 * Class m180808_175454_medicines
 */
class m180808_175454_medicines extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE medecine (
              id BIGSERIAL NOT NULL PRIMARY KEY,
              name TEXT NOT NULL,
              date_from TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT now(),
              date_to TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT now()              
            );
        ");

        $this->execute("
            CREATE TABLE desease (
              id BIGSERIAL NOT NULL PRIMARY KEY,
              name TEXT NOT NULL
            );
        ");

        $this->execute("
            CREATE TABLE medecine2desease (
              id BIGSERIAL NOT NULL PRIMARY KEY,
              medecine_id BIGINT NOT NULL REFERENCES medecine(id),
              desease_id BIGINT NOT NULL REFERENCES desease(id)
            );
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->execute("DROP TABLE medecine2desease;");
       $this->execute("DROP TABLE desease;");
       $this->execute("DROP TABLE medecine;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180808_175454_medicines cannot be reverted.\n";

        return false;
    }
    */
}
