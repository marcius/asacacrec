<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\House $model
 */

$this->title = $model->idHouse;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idHouse], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idHouse], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idHouse',
            'idPage',
            'tribunale',
            'proceduraNum',
            'proceduraAnno',
            'dataPubblicazione',
            'esperimento',
            'dataOrdinanza',
            'indirizzo',
            'info',
            'descrizione',
            'disponibilita',
            'tipologia',
            'superficie',
            'valorePerizia',
            'sincData',
            'sincPrezzo',
            'sincStato',
            'sincEsito',
            'cincData',
            'cincPrezzo',
            'cincStato',
            'cincEsito',
            'dtInsert',
            'dtUpdate',
        ],
    ]) ?>

</div>
