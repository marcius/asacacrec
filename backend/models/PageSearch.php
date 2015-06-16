<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Page;

/**
 * PageSearch represents the model behind the search form about `backend\models\Page`.
 */
class PageSearch extends Page
{
    public function rules()
    {
        return [
            [['idPage', 'refPage', 'httpStatus'], 'integer'],
            [['idSite', 'status', 'statusDetail', 'url', 'html', 'htmlPretty', 'dtInsert', 'dtUpdate'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Page::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idPage' => $this->idPage,
            'refPage' => $this->refPage,
            'httpStatus' => $this->httpStatus,
            'dtInsert' => $this->dtInsert,
            'dtUpdate' => $this->dtUpdate,
        ]);

        $query->andFilterWhere(['like', 'idSite', $this->idSite])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'statusDetail', $this->statusDetail])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'html', $this->html])
            ->andFilterWhere(['like', 'htmlPretty', $this->htmlPretty]);

        return $dataProvider;
    }
}
