<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\House $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="house-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPage')->textInput() ?>

    <?= $form->field($model, 'dtInsert')->textInput() ?>

    <?= $form->field($model, 'dtUpdate')->textInput() ?>

    <?= $form->field($model, 'tribunale')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'dataPubblicazione')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'superficie')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'valorePerizia')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sincData')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sincPrezzo')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sincStato')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'cincData')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'cincPrezzo')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'cincStato')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'proceduraNum')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'proceduraAnno')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'esperimento')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'indirizzo')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'info')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'disponibilita')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'tipologia')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'dataOrdinanza')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'descrizione')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'sincEsito')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cincEsito')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
