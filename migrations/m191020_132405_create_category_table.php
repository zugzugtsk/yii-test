<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m191020_132405_create_category_table extends Migration
{

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'cat' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('category');
    }

}
