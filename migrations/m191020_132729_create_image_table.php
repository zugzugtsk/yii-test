<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m191020_132729_create_image_table extends Migration
{

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'path' => $this->string(),
            'user_id' => $this->integer(),
            'message_id' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('image');
    }

}
