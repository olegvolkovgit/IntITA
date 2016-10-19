<?php

class SuperVisorController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isSuperVisor();
    }

    public function actionOfflineGroups()
    {
        $this->renderPartial('/_super_visor/index', array(), false, true);
    }

    public function actionGetOfflineGroupsList()
    {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('OfflineGroups', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
    }

    public function actionAddNewOfflineGroupForm()
    {
        $this->renderPartial('/_super_visor/_addOfflineGroup', array(), false, true);
    }

    public function actionEditOfflineGroupForm()
    {
        $this->renderPartial('/_super_visor/_editOfflineGroup', array(), false, true);
    }
    
    public function actionGetSpecializationsList()
    {
        echo SpecializationsGroup::specializationsList();
    }

    public function actionGetGroupData()
    {
        echo CJSON::encode(OfflineGroups::model()->findByPk(Yii::app()->request->getParam('id')));
    }

    public function actionCreateOfflineGroup()
    {
        $name=Yii::app()->request->getParam('name');
        $startDate=Yii::app()->request->getParam('date');
        $specializationId=Yii::app()->request->getParam('specialization');
        $city=Yii::app()->request->getParam('city');

        $group= new OfflineGroups();
        $group->name=$name;
        $group->start_date=$startDate;
        $group->specialization=$specializationId;
        $group->city=$city;
        if($group->save()){
            echo 'Оффлайн групу успішно створено';
        }else{
            echo 'Створити групу не вдалося. Введені не вірні дані';
        }

    }

    public function actionUpdateOfflineGroup()
    {
        $id=Yii::app()->request->getPost('id');
        $name=Yii::app()->request->getPost('name');
        $startDate=Yii::app()->request->getPost('date');
        $specializationId=Yii::app()->request->getPost('specialization');
//        $city=Yii::app()->request->getParam('city');

        $group=OfflineGroups::model()->findByPk($id);
        $group->name=$name;
        $group->start_date=$startDate;
        $group->specialization=$specializationId;
//        $group->city=$city;

        if($group->update()){
            echo 'Оффлайн групу успішно оновлено';
        }else{
            echo 'Оновити групу не вдалося. Введені не вірні дані';
        }

    }

    public function actionCitiesByQuery($query){
        echo AddressCity::citiesByQuery($query);
    }
}