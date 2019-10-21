<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class ProfileForm extends ActiveRecord {
// Here we define the name of the table to work with.
public static function tableName(){
  return 'user';
}

public function attributeLabels()
  {
  return [
    'username' => 'Имя',
    'city' => 'Город',
    'phonenum' => 'Номер телефона',
    'about' => 'О себе',
    ];
  }

public function rules()
{
  return [
    [['username','city','phonenum'] , 'required', 'message' => 'Поле обязательно к заполнению'],
    [['phonenum','city'],'number'],
    ['phonenum', 'length' => 10],
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
