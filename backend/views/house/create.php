<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\House $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'House',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
