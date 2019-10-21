<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m191020_131640_create_message_table extends Migration
{

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'user_id' => $this->Integer()->notNull(),
            'status' => $this->boolean()->defaultValue(1),

            'header' =>  $this->string(30),
            'price' => $this->Integer(),
            'category' => $this->Integer(),
            'description' => $this->string(250),
            'city' => $this->Integer()->defaultValue(0),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('message');
    }

}
