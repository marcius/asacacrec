<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\House $model
 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'House',
]) . ' ' . $model->idHouse;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idHouse, 'url' => ['view', 'id' => $model->idHouse]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="house-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
