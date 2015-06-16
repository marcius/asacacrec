<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $idPage
 * @property string $idSite
 * @property integer $refPage
 * @property string $status
 * @property string $statusDetail
 * @property integer $httpStatus
 * @property string $url
 * @property string $html
 * @property string $htmlPretty
 * @property string $dtInsert
 * @property string $dtUpdate
 *
 * @property Houses[] $houses
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idSite', 'refPage', 'status', 'httpStatus', 'url', 'dtInsert', 'dtUpdate'], 'required'],
            [['refPage', 'httpStatus'], 'integer'],
            [['statusDetail', 'html', 'htmlPretty'], 'string'],
            [['dtInsert', 'dtUpdate'], 'safe'],
            [['idSite'], 'string', 'max' => 10],
            [['status'], 'string', 'max' => 5],
            [['url'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPage' => Yii::t('app', 'Page ID'),
            'idSite' => Yii::t('app', 'Site ID'),
            'refPage' => Yii::t('app', 'Original site reference'),
            'status' => Yii::t('app', 'Processing status'),
            'statusDetail' => Yii::t('app', 'Status Detail'),
            'httpStatus' => Yii::t('app', 'HTTP status code'),
            'url' => Yii::t('app', 'URL'),
            'html' => Yii::t('app', 'HTML content'),
            'htmlPretty' => Yii::t('app', 'Html Pretty'),
            'dtInsert' => Yii::t('app', 'Insert date/time'),
            'dtUpdate' => Yii::t('app', 'Update date/time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouses()
    {
        return $this->hasMany(Houses::className(), ['idPage' => 'idPage']);
    }
}
