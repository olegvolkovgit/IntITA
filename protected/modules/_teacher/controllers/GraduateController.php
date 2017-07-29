<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 25.12.2015
 * Time: 14:09
 */

class GraduateController extends TeacherCabinetController {

    public function hasRole(){
        $allowedViewActions=['index','getGraduatesJson', 'view', 'changeStatus', 'create'];
        return Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSuperVisor() ||
        Yii::app()->user->model->isDirector() || Yii::app()->user->model->isSuperAdmin();
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
        $model = Graduate::model()->with('user','courses','modules.idModule','courses.idCourse')->findByPk($id);
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
        $criteria->with = ['user'];
        if (isset($_GET['sorting']['first_name'])){
            $criteria->order = 'user.first_name  COLLATE utf8_unicode_ci ' .$_GET['sorting']['first_name']  ;
        }
        $adapter = new NgTableAdapter('Graduate',$_GET);
        $adapter->mergeCriteriaWith($criteria);
        echo json_encode($adapter->getData());
    }

    public function actionGetusers(){
        $result = [];
        $models =    TypeAheadHelper::getTypeahead($_GET['query'],'StudentReg',['firstName','secondName','email','avatar']);
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
        if (!(Yii::app()->user->model->isSuperadmin() || Yii::app()->user->model->isDirector())){
            $criteria->addInCondition('id_organization',[Yii::app()->user->model->getCurrentOrganizationId()]);
        }
        $courses = Course::model()->findAll($criteria);
        $result = [];
        foreach ($courses as $course){
            array_push($result, $course->getAttributes(['course_ID','title_ua']));
        }
        echo json_encode(['results'=>$result]);
    }

    public function actionGetAllModules(){
        $criteria = new CDbCriteria();
        $criteria->select = ['module_ID','title_ua'];
        $criteria->addSearchCondition('LOWER(title_ua)', mb_strtolower(Yii::app()->request->getQuery('query') , 'UTF-8'), true, 'OR');
        $criteria->addCondition('cancelled=0');
        if (!(Yii::app()->user->model->isSuperadmin() || Yii::app()->user->model->isDirector())){
            $criteria->addInCondition('id_organization',[Yii::app()->user->model->getCurrentOrganizationId()]);
        }
        $courses = Module::model()->findAll($criteria);
        $result = [];
        foreach ($courses as $course){
            array_push($result, $course->getAttributes(['module_ID','title_ua']));
        }
        echo json_encode(['results'=>$result]);
    }

    public function actionAddGraduate(){
        $request = Yii::app()->request->getPost('Graduate');
        $errors=[];
        if(Graduate::model()->findByAttributes(array('id_user'=>$request['user']['id'])))
            $errors=['Випускник уже існує'];
        if(!isset($request['graduate_date']))
            $errors=['Оберіть дату випуску'];
        if (!empty($errors)){
            echo  json_encode(['errors'=>$errors]);
            Yii::app()->end();
        }
        $graduate = new Graduate();

        if($request){
        $graduate->loadModel($request);
        $graduate->published = 1 ;
        }
        $graduate->id_user = $request['user']['id'];
        $date = strtotime($request['graduate_date']);
        $graduate->graduate_date=date_format(date_timestamp_set(new DateTime(),$date),'Y-m-d');

        if(isset($request['course']['course_ID'])){
            $courseRating = new RatingUserCourse();
            $courseRating->id_user = isset($request['user']['id'])?$request['user']['id']:null;
            $courseRating->rating = isset($request['course_rating'])?((double)$request['course_rating']/Config::getRatingScale()):null;
            $courseRating->id_course = isset($request['course']['course_ID'])?$request['course']['course_ID']:null;
            $courseRating->start_course = date_format(date_timestamp_set(new DateTime(),$date),'Y-m-d');
            $courseRating->date_done = date_format(date_timestamp_set(new DateTime(),$date),'Y-m-d');
            $courseRating->course_revision = 1;
            $courseRating->course_done = (int)true;
        }

        if(isset($request['module']['module_ID'])){
            $moduleRating = new RatingUserModule();
            $moduleRating->id_user = isset($request['user']['id'])?$request['user']['id']:null;
            $moduleRating->rating = isset($request['module_rating'])?((double)$request['module_rating']/Config::getRatingScale()):null;
            $moduleRating->id_module = isset($request['module']['module_ID'])?$request['module']['module_ID']:null;
            $moduleRating->start_module = date_format(date_timestamp_set(new DateTime(),$date),'Y-m-d');
            $moduleRating->end_module = date_format(date_timestamp_set(new DateTime(),$date),'Y-m-d');
            $moduleRating->module_revision = 1;
            $moduleRating->module_done = (int)true;
            $moduleRating->paid_module = (int)true;
        }

        $errorsGraduate=[];
        $errorsCourse=[];
        $errorsModule=[];
        if (!$graduate->validate()){
            $errorsGraduate=$graduate->getErrors();
        }
        if (isset($courseRating) && !$courseRating->validate()){
            $errorsCourse=$courseRating->getErrors();
        }
        if (isset($moduleRating) && !$moduleRating->validate()){
            $errorsModule=$moduleRating->getErrors();
        }

        $errors=array_merge($errorsGraduate,$errorsCourse,$errorsModule);
        if (!empty($errors)){
            echo  json_encode(['errors'=>$errors]);
            Yii::app()->end();
        }
        if (isset($courseRating)) {
            $courseRating->save(false);
        }
        if (isset($moduleRating)) {
            $moduleRating->save(false);
        }
        $graduate->save(false);
        echo 'done';
        Yii::app()->end();
    }

    public function actionAddNewUser(){
        $request = Yii::app()->request->getPost('User');
        $user = new StudentReg();
        if ($request){
            $pass = sha1(microtime().'hdssdgcs');
            $user->loadModel($request);
            $user->password =  $pass;
            $user->password_repeat = $pass;
            $user->status = 0;
        }
        $user->setScenario('reguser');
        if ($user->validate()){
            $avatarFile = 'noname.png';
            if (isset($request['avatar']) && !empty($request['avatar'])){
                $avatarFile = uniqid().'.jpg';
                $code_base64 = $request['avatar'];
                $code_base64 = str_replace('data:image/jpeg;base64,','',$code_base64);
                $code_binary = base64_decode($code_base64);
                $image= imagecreatefromstring($code_binary);
                imagejpeg($image,'images/avatars/'.$avatarFile,80);
            }
            $user->avatar = $avatarFile;
            $user->save();
            echo json_encode(['user'=>['id'=>$user->id,'avatar'=>$avatarFile,'fullName'=>$user->fullName()]]);
            Yii::app()->end();
        }
        else{
            echo json_encode(['errors'=>$user->getErrors()]);
            Yii::app()->end();
        }

    }

    public function actionChangeStatus(){
        $id = Yii::app()->request->getPost('id');
        if($id){
            $model = $this->loadModel($id);
            $model->published = !$model->published;
            $model->save();
            echo 'done';
            Yii::app()->end();
        }
        echo 'error';
        Yii::app()->end();
    }

    public function actionGetGraduateData($id){
        $model = $this->loadModel((int)$id);
        $data = array_merge($model->toArray(),['ratingScale'=>Config::getRatingScale()]);
        echo CJSON::encode($data);
        Yii::app()->end();
    }

    public function actionUpdateGraduate(){
        $request = Yii::app()->request->getPost('Graduate');
        $request['graduate_date'] = date('Y-m-d',strtotime($request['graduate_date']));
        $graduate = $this->loadModel($request['id']);
        $user = StudentReg::model()->findByPk($request['id_user']);
        $user->setScenario('edit');
        $user->firstName = $request['user']['firstName'];
        $user->secondName = $request['user']['secondName'];
        $graduate->loadModel($request);
        $graduate->save();
        if ($user->validate(['firstName','secondName'])){
            $user->update(['firstName','secondName']);
        }

    }
}