<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class MessageForm extends ActiveRecord {
// Here we define the name of the table to work with.
public static function tableName(){
  return 'message';
}

public function attributeLabels()
  {
  return [
    'header' => 'Заголовок',
    'price' => 'Цена',
    'description' => 'Описание',
    'category' => 'Категория товара',
    'city' => 'Город',
    ];
  }

public function rules()
{
  return [
    [['header','price','description'] , 'required', 'message' => 'Поле обязательно к заполнению'],
    [['price','user_id','city','category','created_at','updated_at'],'number'],
    ['description', 'trim'],
  ];
}

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
