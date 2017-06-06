<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 25.12.2015
 * Time: 14:09
 */

class GraduateController extends TeacherCabinetController {

    public function hasRole(){
        $allowedViewActions=['index','getGraduatesJson', 'view'];
        return Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSuperVisor() ||
        (Yii::app()->user->model->isDirector() || Yii::app()->user->model->isSuperAdmin() && in_array(Yii::app()->controller->action->id,$allowedViewActions));
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->renderPartial('view', array(
            'model' => $this->loadModel($id)
        ),false,true);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Graduate();
        $intitaUser = new StudentReg();
        $rating = new RatingUserCourse();
        // Uncomment the following line if AJAX validation is needed
//         $this->performAjaxValidation($model);
        if (isset($_POST['Graduate'])) {
            $model->attributes = $_POST['Graduate'];
            $model->avatar = CUploadedFile::getInstance($model, 'avatar');

            if ($model->save()) {
                if (!empty($model->avatar)) {
                    $path = Yii::getPathOfAlias('webroot') . '/images/graduates/' . $model->avatar->getName();
                    $model->avatar->saveAs($path);
                } else {
                    $model->updateByPk($model->id, array('avatar' => 'noname2.png'));
                }
                $this->redirect(Yii::app()->createUrl('/_teacher/cabinet/').'#/graduate');
            }
        }
        $this->renderPartial('create', array(
            'model' => $model, 'user' => $intitaUser, 'rating'=>$rating
        ),false,true);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Graduate'])) {
            $avatarOld = $model->avatar;
            $model->attributes = $_POST['Graduate'];
            $model->avatar = CUploadedFile::getInstance($model, 'avatar');

            if ($model->save()) {
                if (!empty($model->avatar)) {
                    $path = Yii::getPathOfAlias('webroot') . '/images/graduates/' . $model->avatar->getName();
                    $model->avatar->saveAs($path);
                } else {
                    if ($avatarOld != null) {
                        $model->updateByPk($model->id, array('avatar' => $avatarOld));
                    } else {
                        $model->updateByPk($model->id, array('avatar' => 'noname2.png'));
                    }
                }
                $this->redirect(Yii::app()->createUrl('/_teacher/cabinet/').'#/graduate');
            }
        }
        $this->renderPartial('update', array(
            'model' => $model
        ),false,true);
    }

    /**
     * Deletes a particular model.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete()
    {
        $id = Yii::app()->request->getPost('id', 0);

        if($this->loadModel($id)->delete())
            echo "Операцію успішно виконано.";
        else
            echo "Операцію не вдалося виконати.";
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->renderPartial('index', array(), false, true);
    }

     /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Graduate the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Graduate::model()->with('rate','user','course')->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionDeletePhoto(){
        $id = Yii::app()->request->getPost('id', '0');
        if($id != 0){
            echo Graduate::model()->updateByPk($id, array('avatar' => 'noname2.png'));
        }
        //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : '/_admin/graduate/'.$id);
    }
    /**
     * Performs the AJAX validation.
     * @param Graduate $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'graduate-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetGraduatesList(){
        echo Graduate::graduatesList();
    }

    public function actionGetGraduatesJson(){

        $criteria = new CDbCriteria();
        $criteria->with = ['rate','user'];
        if (isset($_GET['sorting']['first_name'])){
            $criteria->order = 'user.first_name  COLLATE utf8_unicode_ci ' .$_GET['sorting']['first_name']  ;
        }
        $adapter = new NgTableAdapter('Graduate',$_GET);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetusers(){
        $result = [];
        $models = TypeAheadHelper::getTypeahead($_GET['query'],'StudentReg',['firstName','secondName','email','avatar']);
        foreach ($models as $model){
            $arr = $model->getAttributes(['id','avatar','email','firstName','secondName']);
            $arr['fullName'] = $model->fullName();
            array_push($result,$arr);
           unset($arr);
        }
        echo json_encode(['results'=>$result]);
    }

    public function actionGetAllCourses(){
        $criteria = new CDbCriteria();
        $criteria->select = ['course_ID','title_ua'];
        $criteria->addSearchCondition('LOWER(title_ua)', mb_strtolower(Yii::app()->request->getQuery('query') , 'UTF-8'), true, 'OR');
        $criteria->addCondition('cancelled=0');
        if (!Yii::app()->user->model->isSuperadmin()||Yii::app()->user->model->isDirector()){
            $criteria->addInCondition('id_organization',[1]);
        }
        $courses = Course::model()->findAll($criteria);
        $result = [];
        foreach ($courses as $course){
            array_push($result, $course->getAttributes(['course_ID','title_ua']));
        }
        echo json_encode(['results'=>$result]);
    }

    public function actionAddGraduate(){
        $request = Yii::app()->request->getPost('Graduate');
        $graduate = new Graduate();
        if($request){
        $graduate->loadModel($request);
        }
        $courseRating = new RatingUserCourse();
        $courseRating->id_user = isset($request['user']['id'])?$request['user']['id']:null;
        $courseRating->rating = isset($request['rate'])?(double)$request['rate']:null;
        $courseRating->id_course = isset($request['course']['course_ID'])?$request['course']['course_ID']:null;
        $courseRating->course_revision = 0;
        if (!($graduate->validate() && $courseRating->validate())){
            echo  json_encode(['errors'=>array_merge($graduate->getErrors(),$courseRating->getErrors())]);
            Yii::app()->end();
        }
        $courseRating->save(false);
        $graduate->rate = $courseRating->id;
        $graduate->save(false);
        echo 'done';
        Yii::app()->end();
    }
}