<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var backend\models\HouseSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Houses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'House',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idHouse',
            'idPage',
            'tribunale',
            'proceduraNum',
            'proceduraAnno',
            // 'dataPubblicazione',
            // 'esperimento',
            // 'dataOrdinanza',
            // 'indirizzo',
            // 'info',
            // 'descrizione',
            // 'disponibilita',
            // 'tipologia',
            // 'superficie',
            // 'valorePerizia',
            // 'sincData',
            // 'sincPrezzo',
            // 'sincStato',
            // 'sincEsito',
            // 'cincData',
            // 'cincPrezzo',
            // 'cincStato',
            // 'cincEsito',
            // 'dtInsert',
            // 'dtUpdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
