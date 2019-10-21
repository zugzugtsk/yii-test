<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m191020_132622_create_city_table extends Migration
{

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'cityname' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('city');
    }

}
