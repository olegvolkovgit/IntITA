<?php

class TemplateController extends TeacherCabinetController
{
    public function hasRole(){
        $allowedActions=['getAgreementTemplate'];

        return Yii::app()->user->model->isAuditor() ||
            (Yii::app()->user->model->isAccountant() || Yii::app()->user->model->isStudent()
                && in_array(Yii::app()->controller->action->id,$allowedActions));
    }

    public function actionIndex($id=0)
    {
        $this->renderPartial('index', array(), false, true);
    }

    public function actionOffer()
    {
        $this->renderPartial('offer',array(),false,true);
    }

    public function actionEditOffer($lang){
        $this->renderPartial('_editOffer',array(
            'lang' => $lang
        ),false,true);
    }

    public function actionUpdateOffer(){
        $lang = Yii::app()->request->getPost('lang', '');
        $text = Yii::app()->request->getPost('text', '');

        $url = 'files/offers/offer_' . $lang . '.html';
        if(file_put_contents($url, $text)){
            echo 'Зміни успішно збережено.';
        } else {
            echo 'Зміни не вдалося зберегти.';
        }
    }

    public function actionWrittenAgreement()
    {
        $this->renderPartial('writtenAgreement', array(), false, true);
    }

    public function actionWrittenAgreementsList()
    {
        $this->renderPartial('writtenAgreementsList', array(), false, true);
    }

    public function actionUpdateWrittenAgreement()
    {
        $this->renderPartial('updateWrittenAgreement', array(), false, true);
    }

    public function actionUpdateAgreementTemplate(){
        $template = Yii::app()->request->getPost('template');

        $model=WrittenAgreementTemplate::model()->findByPk(1);
        $model->template=$template;
        $model->create_by=Yii::app()->user->getId();
        $model->save();
    }

    public function actionGetAgreementTemplate(){
        $params = array_filter($_POST);
        $data['data']=WrittenAgreementTemplate::model()->findByPk(1)->template;
        echo json_encode($data);
    }

    public function actionGetAgreementWrittenTemplateList() {
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('WrittenAgreementTemplate', $requestParams);
        $criteria =  new CDbCriteria();
        $criteria->alias = 't';
        $criteria->addCondition('t.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        echo json_encode($result);
    }
}