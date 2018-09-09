<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Holidays */

$this->title = 'Добавление отпуска';
?>
<div class="holidays-create">

    <div class="panel panel-default">
        <div class="panel-heading panel-top-title"><?= Html::encode($this->title) ?> - <?= Html::encode(Yii::$app->user->identity->fio) ?></div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
