<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<!-- Login check. Redirect to login page if failed -->
<?php
       if(Yii::$app->user->isGuest){
        return Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
       }
?>
<?php $items1 = ArrayHelper::map($cats,'id','cat') ?>
<?php $items2 = ArrayHelper::map($cities,'id','cityname') ?>

<?php $form = ActiveForm::begin(['options' => ['id' => 'MessageForm']]) ?>
<?= $form->field($message, 'header') ?>
<?= $form->field($message, 'price') ?>
<?= $form->field($message, 'description') ?>
<?php echo $form->field($message, 'category')->dropDownList($items1); ?>
<?php echo $form->field($message, 'city')->dropDownList($items2); ?>
<?= Html::submitButton('Создать', ['class' => 'btn btn-success'])?>
<?php ActiveForm::end() ?>
