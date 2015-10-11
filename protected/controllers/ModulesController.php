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
        $criteria = new CDbCriteria();
        $criteria->condition = 'cancelled=0';
        $dataProvider = new CActiveDataProvider('Module', array(
            'criteria' => $criteria,
            'pagination'=>array('pageSize'=>50)
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
}