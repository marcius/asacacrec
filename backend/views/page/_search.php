<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\PageSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="page-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPage') ?>

    <?= $form->field($model, 'idSite') ?>

    <?= $form->field($model, 'refPage') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'statusDetail') ?>

    <?php // echo $form->field($model, 'httpStatus') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'html') ?>

    <?php // echo $form->field($model, 'htmlPretty') ?>

    <?php // echo $form->field($model, 'dtInsert') ?>

    <?php // echo $form->field($model, 'dtUpdate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
