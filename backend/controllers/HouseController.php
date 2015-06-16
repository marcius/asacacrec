<?php

namespace backend\controllers;

use backend\models\House;

/**
 * HouseController implements the CRUD actions for House model.
 */
class HouseController extends BaseHouseController
{

    public function actionViewm($house)
    {
        return $this->render('view', [
            'model' => $house,
        ]);
    }

}
