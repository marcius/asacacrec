<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "houses".
 *
 * @property integer $idHouse
 * @property integer $idPage
 * @property string $tribunale
 * @property string $proceduraNum
 * @property string $proceduraAnno
 * @property string $dataPubblicazione
 * @property string $esperimento
 * @property string $dataOrdinanza
 * @property string $indirizzo
 * @property string $info
 * @property string $descrizione
 * @property string $disponibilita
 * @property string $tipologia
 * @property string $superficie
 * @property string $valorePerizia
 * @property string $sincData
 * @property string $sincPrezzo
 * @property string $sincStato
 * @property string $sincEsito
 * @property string $cincData
 * @property string $cincPrezzo
 * @property string $cincStato
 * @property string $cincEsito
 * @property string $dtInsert
 * @property string $dtUpdate
 *
 * @property Pages $idPage0
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'houses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPage'], 'integer'],
            [['dtInsert', 'dtUpdate'], 'safe'],
            [['tribunale', 'dataPubblicazione', 'superficie', 'valorePerizia', 'sincData', 'sincPrezzo', 'sincStato', 'cincData', 'cincPrezzo', 'cincStato'], 'string', 'max' => 20],
            [['proceduraNum', 'proceduraAnno'], 'string', 'max' => 10],
            [['esperimento', 'indirizzo', 'info', 'disponibilita', 'tipologia'], 'string', 'max' => 100],
            [['dataOrdinanza'], 'string', 'max' => 45],
            [['descrizione'], 'string', 'max' => 200],
            [['sincEsito', 'cincEsito'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idHouse' => Yii::t('app', 'House ID'),
            'idPage' => Yii::t('app', 'Page ID'),
            'tribunale' => Yii::t('app', 'Tribunale'),
            'proceduraNum' => Yii::t('app', 'Procedura Num'),
            'proceduraAnno' => Yii::t('app', 'Procedura Anno'),
            'dataPubblicazione' => Yii::t('app', 'Data Pubblicazione'),
            'esperimento' => Yii::t('app', 'Esperimento'),
            'dataOrdinanza' => Yii::t('app', 'Data Ordinanza'),
            'indirizzo' => Yii::t('app', 'Indirizzo'),
            'info' => Yii::t('app', 'Info'),
            'descrizione' => Yii::t('app', 'Description'),
            'disponibilita' => Yii::t('app', 'Disponibilita'),
            'tipologia' => Yii::t('app', 'Tipologia'),
            'superficie' => Yii::t('app', 'Superficie'),
            'valorePerizia' => Yii::t('app', 'Valore Perizia'),
            'sincData' => Yii::t('app', 'Sinc Data'),
            'sincPrezzo' => Yii::t('app', 'Sinc Prezzo'),
            'sincStato' => Yii::t('app', 'Sinc Stato'),
            'sincEsito' => Yii::t('app', 'Sinc Esito'),
            'cincData' => Yii::t('app', 'Cinc Data'),
            'cincPrezzo' => Yii::t('app', 'Cinc Prezzo'),
            'cincStato' => Yii::t('app', 'Cinc Stato'),
            'cincEsito' => Yii::t('app', 'Cinc Esito'),
            'dtInsert' => Yii::t('app', 'Insert date'),
            'dtUpdate' => Yii::t('app', 'Update date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPage0()
    {
        return $this->hasOne(Pages::className(), ['idPage' => 'idPage']);
    }
}
