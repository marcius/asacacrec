<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\HouseSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="house-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idHouse') ?>

    <?= $form->field($model, 'idPage') ?>

    <?= $form->field($model, 'tribunale') ?>

    <?= $form->field($model, 'proceduraNum') ?>

    <?= $form->field($model, 'proceduraAnno') ?>

    <?php // echo $form->field($model, 'dataPubblicazione') ?>

    <?php // echo $form->field($model, 'esperimento') ?>

    <?php // echo $form->field($model, 'dataOrdinanza') ?>

    <?php // echo $form->field($model, 'indirizzo') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'descrizione') ?>

    <?php // echo $form->field($model, 'disponibilita') ?>

    <?php // echo $form->field($model, 'tipologia') ?>

    <?php // echo $form->field($model, 'superficie') ?>

    <?php // echo $form->field($model, 'valorePerizia') ?>

    <?php // echo $form->field($model, 'sincData') ?>

    <?php // echo $form->field($model, 'sincPrezzo') ?>

    <?php // echo $form->field($model, 'sincStato') ?>

    <?php // echo $form->field($model, 'sincEsito') ?>

    <?php // echo $form->field($model, 'cincData') ?>

    <?php // echo $form->field($model, 'cincPrezzo') ?>

    <?php // echo $form->field($model, 'cincStato') ?>

    <?php // echo $form->field($model, 'cincEsito') ?>

    <?php // echo $form->field($model, 'dtInsert') ?>

    <?php // echo $form->field($model, 'dtUpdate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
