<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 29.12.2015
 * Time: 17:08
 */

class ConfigController extends TeacherCabinetController {

    public $menu = array();

    public function hasRole(){
        return Yii::app()->user->model->isSuperAdmin();
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        if (Config::model()->findByPk($id)->hidden == 1){
            throw new CHttpException(403, 'У вас недостатньо прав для редагування цього параметра.');
        }

        $this->renderPartial('view',array(
            'model'=>$this->loadModel($id),
        ),false,true);
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        if ($model->hidden == 1){
            throw new CHttpException(403, 'У вас недостатньо прав для редагування цього параметра.');
        }

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if(isset($_POST['Config']))
        {
            $model->attributes=$_POST['Config'];
            if($model->save()) {
                Yii::app()->cache->flush();
                $this->redirect(Yii::app()->createUrl('cabinet/').'#/configuration/siteconfig');
            }
        }

        $this->renderPartial('update',array(
            'model'=>$model,
        ),false,true);
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Config('search');

        $this->renderPartial('index',array(
            'model' => $model,
        ), false, true);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Config the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Config::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Config $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='config-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionRefresh()
    {
        Yii::app()->cache->flush();
        echo 'success';
    }

    public function actionGetConfigList($page = 0, $pageCount=10){
        $criteria = new CDbCriteria([
            'offset' => $page*$pageCount -$pageCount,
            'limit' => $pageCount,

        ]);
        echo JsonForNgDatatablesHelper::returnJson(Config::model()->findAll($criteria),null,Config::model()->count());
    }

    public function actionCareers()
    {
        $this->renderPartial('/_super_admin/config/careers/careers', array(), false, true);
    }

    public function actionCareerCreate()
    {
        $this->renderPartial('/_super_admin/config/careers/careerCreate', array(), false, true);
    }

    public function actionCareerUpdate()
    {
        $this->renderPartial('/_super_admin/config/careers/careerUpdate', array(), false, true);
    }

    public function actionGetCareersList()
    {
        echo Careers::careersList();
    }

    public function actionCreateCareer()
    {
        $title_ua=Yii::app()->request->getPost('title_ua');
        $title_ru=Yii::app()->request->getPost('title_ru');
        $title_en=Yii::app()->request->getPost('title_en');
        
        $career=new Careers();
        $career->title_ua=$title_ua;
        $career->title_ru=$title_ru;
        $career->title_en=$title_en;
        
        if($career->save()){
            echo "Кар'єру створено";
        }else{
            echo "Створити кар'єру не вдалося. Введені не вірні дані";
        }
    }

    public function actionGetCareerData()
    {
        echo CJSON::encode(Careers::model()->findByPk(Yii::app()->request->getParam('id')));
    }

    public function actionUpdateCareer()
    {
        $id=Yii::app()->request->getPost('id');
        $title_ua=Yii::app()->request->getPost('title_ua');
        $title_ru=Yii::app()->request->getPost('title_ru');
        $title_en=Yii::app()->request->getPost('title_en');

        $career=Careers::model()->findByPk($id);
        $career->title_ua=$title_ua;
        $career->title_ru=$title_ru;
        $career->title_en=$title_en;

        if($career->update()){
            echo 'Кар\'єру оновлено';
        }else{
            echo 'Оновити кар\'єру не вдалося. Введені не вірні дані';
        }

    }
}