<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Holidays */

$this->title = 'Обновить даты отпуска';
?>
<div class="holidays-update">
    <div class="panel panel-default">
        <div class="panel-heading panel-top-heading"><?= Html::encode($this->title) ?></div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
