<?php

class GraduateController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Graduate');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
}