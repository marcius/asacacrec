<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\House;

/**
 * HouseSearch represents the model behind the search form about `backend\models\House`.
 */
class HouseSearch extends House
{
    public function rules()
    {
        return [
            [['idHouse', 'idPage'], 'integer'],
            [['tribunale', 'proceduraNum', 'proceduraAnno', 'dataPubblicazione', 'esperimento', 'dataOrdinanza', 'indirizzo', 'info', 'descrizione', 'disponibilita', 'tipologia', 'superficie', 'valorePerizia', 'sincData', 'sincPrezzo', 'sincStato', 'sincEsito', 'cincData', 'cincPrezzo', 'cincStato', 'cincEsito', 'dtInsert', 'dtUpdate'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = House::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idHouse' => $this->idHouse,
            'idPage' => $this->idPage,
            'dtInsert' => $this->dtInsert,
            'dtUpdate' => $this->dtUpdate,
        ]);

        $query->andFilterWhere(['like', 'tribunale', $this->tribunale])
            ->andFilterWhere(['like', 'proceduraNum', $this->proceduraNum])
            ->andFilterWhere(['like', 'proceduraAnno', $this->proceduraAnno])
            ->andFilterWhere(['like', 'dataPubblicazione', $this->dataPubblicazione])
            ->andFilterWhere(['like', 'esperimento', $this->esperimento])
            ->andFilterWhere(['like', 'dataOrdinanza', $this->dataOrdinanza])
            ->andFilterWhere(['like', 'indirizzo', $this->indirizzo])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'descrizione', $this->descrizione])
            ->andFilterWhere(['like', 'disponibilita', $this->disponibilita])
            ->andFilterWhere(['like', 'tipologia', $this->tipologia])
            ->andFilterWhere(['like', 'superficie', $this->superficie])
            ->andFilterWhere(['like', 'valorePerizia', $this->valorePerizia])
            ->andFilterWhere(['like', 'sincData', $this->sincData])
            ->andFilterWhere(['like', 'sincPrezzo', $this->sincPrezzo])
            ->andFilterWhere(['like', 'sincStato', $this->sincStato])
            ->andFilterWhere(['like', 'sincEsito', $this->sincEsito])
            ->andFilterWhere(['like', 'cincData', $this->cincData])
            ->andFilterWhere(['like', 'cincPrezzo', $this->cincPrezzo])
            ->andFilterWhere(['like', 'cincStato', $this->cincStato])
            ->andFilterWhere(['like', 'cincEsito', $this->cincEsito]);

        return $dataProvider;
    }
}
