<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\Page $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idSite')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'refPage')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 3]) ?>

    <?= $form->field($model, 'httpStatus')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'dtInsert')->textInput() ?>

    <?= $form->field($model, 'dtUpdate')->textInput() ?>

    <?= $form->field($model, 'statusDetail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'html')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'htmlPretty')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
