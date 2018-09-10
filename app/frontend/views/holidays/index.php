<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use app\models\Holidays;
use common\models\User;
use common\helpers\RolesHelper;

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
                    <div class="pull-right">
                        <?= Html::a('Список моих отпусков', ['?HolidaysSearch[user_id]=' . Yii::$app->user->getId()], ['class' => 'my-holidays-btn btn btn-sm btn-primary']) ?>
                        <?= Html::a('Добавить отпуск', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
                    </div>
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
                    return date('d.m.Y', strtotime($model->date_start));
                }],
                ['header' => 'Окончание отпуска', 'value' => function ($model) {
                    return date('d.m.Y', strtotime($model->date_end));
                }],
                ['header' => 'Подтвержден', 'value' => function ($model) {
                    return $model->approved ? 'Да' : 'Нет';
                }],
                ['format' => 'html', 'contentOptions' => ['class' => 'text-right'], 'value' => function ($model) {
                    $buttons = false;
                    if ($model->user_id === Yii::$app->user->identity->getId() && $model->approved !== Holidays::HOLIDAY_APPROVED) {
                        $buttons = Html::a('<i class="fas fa-pen-square"></i>', ["update?id={$model->id}"], ['class' => 'edit-btn btn btn-primary btn-xs', 'title' => 'Редактировать']);
                    }

                    if (RolesHelper::isAdmin() && $model->approved !== Holidays::HOLIDAY_APPROVED) {
                        $buttons .= Html::a('<i class="fas fa-check-square"></i>', ["approve?id={$model->id}"], ['class' => 'approve-btn btn btn-success btn-xs', 'title' => 'Одобрить отпуск']);
                    }

                    return $buttons ?: false;
                }],
            ];
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns'      => $columns,
            ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>
</div>
