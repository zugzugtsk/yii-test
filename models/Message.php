<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $header
 * @property int $price
 * @property int $category
 * @property string $description
 * @property int $city
 * @property int $created_at
 * @property int $updated_at
 */
class Message extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
     // Для того, чтобы модель проходила валидацию, created_at и updated_at убираем из обязательных полей. Они будут заполнены с помощью соответствующего поведения
    public function rules()
    {
        return [
            [['user_id', 'price', 'header', 'category', 'city','description'], 'required'],
            [['user_id', 'status', 'price', 'category', 'city'], 'integer'],
            [['header'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'header' => 'Header',
            'price' => 'Price',
            'category' => 'Category',
            'description' => 'Description',
            'city' => 'City',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
// Поведение Timestamp заполняет в БД соответствующие поля
public function behaviours()
{
 return [
   'timestamp' => [
     'class' => TimestampBehavior::className(),
     'attributes' => [
       ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
       ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
     ],
     'value' => new Expression('NOW()'),
   ]
 ];
}

}
