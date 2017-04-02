<?php

/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 28.12.2015
 * Time: 15:11
 */
class ModuleController extends TeacherCabinetController
{
    public function hasRole(){

        return Yii::app()->user->model->isAdmin();
    }

    public function actionUpdateModulePrice($id,$price)
    {
        $module = Module::model()->findByPk($id);
        if(Yii::app()->user->model->getCurrentOrganization()->id==$module->id_organization){
            $result=array();
            $module->module_price=$price;
            if($module->save())
                $result['data']="success";
            else $result['data']='Виникла помилка';
            echo json_encode($result);
        }else{
            throw new \application\components\Exceptions\IntItaException(403, "Не має доступу");
        }
    }
}