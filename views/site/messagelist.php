
<?php
use yii\widgets\LinkPager;
$this->title = 'Доска объявлений';
?>

<?php foreach($messages as $message): ?>
    <div class="panel panel-default">
      <div class="panel-heading"><?= $message->header ?></div>
        <div class="panel-body">
          <p>Цена:<?= $message->price ?></p></br>
          <p>Описание:<?= $message->description ?></p></br>
          <div class="panel-footer"><?= $message->created_at ?></div>
        </div>
    </div>
<?php endforeach; ?>


<?= LinkPager::widget([
    'pagination' => $pages,
]); ?>
