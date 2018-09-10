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
                    <div class="pull-right">
                        <?= Html::a('Список моих отпусков', ['?HolidaysSearch[user_id]=' . Yii::$app->user->getId()], ['class' => 'btn btn-sm btn-primary', 'style' => 'margin-right: 20px;']) ?>
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
                ['header' => 'Действия', 'format' => 'html', 'value' => function ($model) {
                    if ($model->user_id === Yii::$app->user->identity->getId()) {
                        $buttons = '<a href="/holidays/update?id=' . $model->id . '" title="Редактировать" aria-label="Редактировать" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
                        if  (Yii::$app->user->identity->role === User::ROLE_MANAGER || Yii::$app->user->identity->role === User::ROLE_ADMIN)
                        {
                            $buttons .= '<a href="/holidays/approve?id=' . $model->id . '" title="Подтвердить" aria-label="Подтвердить" data-pjax="0"><span class="glyphicon glyphicon-apple"></span></a>';

                        }
                        return $buttons;

                    }
                    return false;
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
