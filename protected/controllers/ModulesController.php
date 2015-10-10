<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 11.10.2015
 * Time: 2:21
 */

class ModulesController extends Controller{
    public function actionIndex()
    {

        $dataProvider = new CActiveDataProvider('Module', array(
            'pagination'=>array('pageSize'=>50)
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
}