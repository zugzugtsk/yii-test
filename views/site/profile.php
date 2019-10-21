<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<!-- Get UserID for further operations -->

<?php $city = ArrayHelper::map($cities,'id','cityname') ?>

<?php $form = ActiveForm::begin(['options' => ['id' => 'ProfileForm']]) ?>
<?= $form->field($user, 'username') ?>
<?= $form->field($user, 'phonenum') ?>
<?= $form->field($user, 'about') ?>
<?php echo $form->field($user, 'city')->dropDownList($city); ?>
<?= Html::submitButton('Обновить', ['class' => 'btn btn-success'])?>
<?php ActiveForm::end() ?>
