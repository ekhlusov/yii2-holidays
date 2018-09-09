<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Holidays */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="holidays-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput()->hiddenInput(['value' => Yii::$app->user->identity->getId()])->label(false) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date_start')
                ->widget(\yii\jui\DatePicker::className(), [
                    'options' => ['class' => 'form-control'],
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'date_end')
                ->widget(\yii\jui\DatePicker::className(), [
                'options' => ['class' => 'form-control'],
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
