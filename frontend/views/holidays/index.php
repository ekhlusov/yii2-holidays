<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HolidaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список отпусков';
?>
<div class="holidays-index">
    <?php Pjax::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6 panel-top-title"><?= Html::encode($this->title) ?></div>
                <div class="col-md-6">
                    <?= Html::a('Добавить отпуск', ['create'], ['class' => 'btn btn-sm btn-success pull-right']) ?>
                </div>
            </div>


        </div>
        <div class="panel-body">

            <?php
            $columns = [
                ['header' => 'Сотрудник', 'value' => function ($model) {
                    return User::findById($model->user_id)->fio ?: '-';
                }
                ],
                ['header' => 'Начало отпуска', 'value' => function ($model) {
                    return date("d.m.Y", strtotime($model->date_start));
                }],
                ['header' => 'Окончание отпуска', 'value' => function ($model) {
                    return date("d.m.Y", strtotime($model->date_end));
                }],
                ['header' => 'Подтвержден', 'value' => function ($model) {
                    return $model->approved ? 'Да' : 'Нет';
                }],
                ['class' => 'yii\grid\ActionColumn', 'visible' => Yii::$app->user->getId()]
            ];
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns'      => $columns,
            ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>
</div>
