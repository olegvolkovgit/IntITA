<?php
use application\components\Exceptions\IntItaException as IntitaException;

class StudentRegController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function actionCountryAutoComplete($term, $lang)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('title_' . $lang, $term, true);
        $model = new AddressCountry();
        $results = [];
        $param = "title_" . $lang;
        foreach ($model->findAll($criteria) as $m) {
            $results[] = array('id' => $m->id, 'value' => $m->$param);
        }
        echo CJSON::encode($results);
    }

    public function actionCityAutoComplete($country, $term)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('country', $country, true);
        $criteria->compare('title_ua', $term, true);
        $model = new AddressCity();
        $result = [];
        foreach ($model->findAll($criteria) as $m) {
            $result[] = array('id' => $m->id, 'value' => $m->title_ua);
        }
        echo CJSON::encode($result);
    }

    /**
     * Lists all models.
     */
    public function actionIndex($email = '')
    {
        if (!Yii::app()->user->isGuest) {
            throw new \application\components\Exceptions\IntItaException('403', 'Ти вже зареєстрований');
        }
        $model = new StudentReg('reguser');
        $this->render("studentreg", array('model' => $model, 'email' => $email));
    }

    public function actionRegistration()
    {
        $model = new StudentReg('reguser');
        
        $careers=json_decode($_POST['careers']);
        $specializations=json_decode($_POST['specializations']);
        $avatarBase64=$_POST['avatar'];
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatarBase64));

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['StudentReg'])) {
            if ($_POST['educformOff']) {
                $_POST['StudentReg']['educform'] = EducationForm::ONLINE_OFFLINE;
                $_POST['StudentReg']['education_shift'] = $_POST['shift']?$_POST['shift']:EducationShift::ALL_ONE;
            } else {
                $_POST['StudentReg']['educform'] = EducationForm::ONLINE;
            }
            $model->attributes = $_POST['StudentReg'];
            if ($model->password !== Null){
                $model->password = sha1($model->password);
                $model->password_repeat = sha1($model->password_repeat);
            }

            $getToken = rand(0, 99999);
            $getTime = date("Y-m-d H:i:s");
            $model->token = sha1($getToken . $getTime);

            if ($model->validate()) {
                if ($avatarBase64) {
                    $fileName = FileUploadHelper::getFileNameForBase64();
                    Avatar::saveStudentAvatar($model, $data, $fileName);
                }

                if (Yii::app()->session['lg']) $lang = Yii::app()->session['lg'];
                else $lang = 'ua';
                $model->save();

                if($careers) $model->createUserCareer($careers);
                if($specializations) $model->createUserSpecialization($specializations);

                if ($model->avatar == Null) {
                    $thisModel = new StudentReg();
                    $thisModel->updateByPk($model->id, array('avatar' => 'noname.png'));
                }
                $sender = new MailTransport();
                $sender->renderBodyTemplate('_registrationMail', array($model, $lang));
                if (!$sender->send($model->email, "", Yii::t('activeemail', '0298'), ""))
                    throw new \application\components\Exceptions\MailException('The letter was not sent ');

                $this->redirect(Yii::app()->createUrl('/site/activationinfo', array('email' => $model->email)));
            } else {
                $this->render("studentreg", array('model' => $model));
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return StudentReg the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = StudentReg::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param StudentReg $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'student-profile-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionProfile($idUser)
    {
        if (Yii::app()->user->isGuest) {
            $this->render('/site/authorize');
            die();
        }
        if (Yii::app()->user->isGuest || $idUser == 0)
            throw new \application\components\Exceptions\IntItaException('403', 'Гість не може проглядати профіль користувача');
        $user = RegisteredUser::userById($idUser);
        if (!$user)
            throw new \application\components\Exceptions\IntItaException('404', 'Такого користувача немає');
        $model = $user->registrationData;
        $addressString = $model->addressString();

        $dataProvider = $model->getDataProfile();
        $markProvider = $model->getMarkProviderData();
        
        $owner = false;
        if ($idUser == Yii::app()->user->getId()) {
            $owner = true;
        }

        $this->render("profile", array(
            'dataProvider' => $dataProvider,
            'post' => $model,
            'user' => $user,
            'markProvider' => $markProvider,
            'addressString' => $addressString,
            'owner' => $owner
        ));
    }

    public function actionEdit()
    {
        if (Yii::app()->user->isGuest) {
            $this->render('/site/authorize');
            die();
        }
        $model = new StudentReg('edit');

        $this->render("studentprofileedit", array('model' => $model));

    }

    public function actionRewrite()
    {

        $id = Yii::app()->user->id;
        $model = $this->loadModel($id);
        $model->setScenario('edit');

        $careers=json_decode($_POST['careers']);
        $specializations=json_decode($_POST['specializations']);
        $avatarBase64=$_POST['avatar'];
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatarBase64));

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'editProfile-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if ($_POST['educformOff']) {
            $_POST['StudentReg']['educform'] = EducationForm::ONLINE_OFFLINE;
            $_POST['StudentReg']['education_shift'] = isset($_POST['shift'])?$_POST['shift']:EducationShift::ALL_ONE;
        } else {
            $_POST['StudentReg']['educform'] = EducationForm::ONLINE;
            $_POST['StudentReg']['education_shift'] = null;
        }

        $model->attributes = $_POST['StudentReg'];
        if ($model->validate()) {
            if ($avatarBase64) {
                $fileName = FileUploadHelper::getFileNameForBase64();
                Avatar::saveStudentAvatar($model, $data, $fileName);
            }

            $model->update(array('firstName','secondName','nickname','phone','address','education','educform','interests','aboutUs','aboutMy','facebook','googleplus',
                'linkedin','twitter','skype','passport','document_type','inn','passport_issued','prev_job','current_job','education_shift'));
            $model->updateUserCareer($careers);
            $model->updateUserSpecialization($specializations);

            if (isset($_POST['StudentReg']['birthday'])){
                $format = "d/m/Y";
                if ($_POST['StudentReg']['birthday'] !="")
                    $model->updateByPk($id, array('birthday' => date_format(DateTime::createFromFormat($format, $_POST['StudentReg']['birthday']),'Y-m-d')));
                else
                    $model->updateByPk($id, array('birthday' => null));
            }
            if (isset($_POST['StudentReg']['document_issued_date'])){
                $format = "d/m/Y";
                if ($_POST['StudentReg']['document_issued_date'] !="")
                    $model->updateByPk($id, array('document_issued_date' => date_format(DateTime::createFromFormat($format, $_POST['StudentReg']['document_issued_date']),'Y-m-d')));
                else
                    $model->updateByPk($id, array('document_issued_date' => null));
            }

            if (isset($_POST['StudentReg']['country'])) {
                $model->updateByPk($id, array('country' => $_POST['StudentReg']['country']));

                if(!empty($_POST['StudentReg']['country'])){
                    $cityId = AddressCity::newUserCity($_POST['StudentReg']['city'], $_POST['cityTitle'], $_POST['StudentReg']['country']);
                    $model->updateByPk($id, array('city' => $cityId));   
                }else{
                    $model->updateByPk($id, array('city' => null));
                }
            }

            if (!empty($_POST['StudentReg']['password']) && sha1($_POST['StudentReg']['password']) == sha1($_POST['StudentReg']['password_repeat']))
                $model->updateByPk($id, array('password' => sha1($_POST['StudentReg']['password'])));

            $callUrl = new CurlHelper();
            $callUrl->callPageByCurl(Config::getFullChatPath().'/chat/update/users/name');

            $this->redirect(Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)));
        } else
            $this->render("studentprofileedit", array('model' => $model));
    }

    public function actionChangepass()
    {
        $modeltest = new StudentReg('changepass');
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'change-form') {
            echo CActiveForm::validate($modeltest);
            Yii::app()->end();
        }
        $id = Yii::app()->user->id;
        $model = StudentReg::model()->findByPk($id);
        $atr = Yii::app()->request->getPost('StudentReg');
        $pass = $atr ['password'];
        if ($model->getPassword() == sha1($pass)) {
            if (isset($_POST['StudentReg'])) {
                $model->updateByPk($id, array('password' => sha1($_POST['StudentReg']['new_password'])));
                $this->redirect(Yii::app()->createUrl('studentreg/profile', array('idUser' => Yii::app()->user->getId())));
            }
        }
    }

    public function actionDeleteavatar()
    {
        Avatar::deleteStudentAvatar();

        $this->redirect(Yii::app()->createUrl('studentreg/edit'));
    }

    public function actionTimetableProvider($user, $tab, $owner)
    {
        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id' => $user));

        $data = Teacher::getTeacherSchedule($teacher, $user, $tab);

        $this->renderPartial('_timetableprovider', array('dataProvider' => $data, 'userId' => $user, 'owner' => $owner));
    }

    public function actionGetProfileData()
    {
        $id = Yii::app()->request->getPost('id', 0);
        $model = RegisteredUser::userById($id);
        $teacher_attributes = [];
        $graduate = [];
        if($model->trainer){
            $trainers=array();
            foreach ($model->trainer as $key=>$trainer) {
                $trainers[$key]=array('name'=>$trainer->trainerModel->userNameWithEmail(),
                    'link'=>Yii::app()->createUrl('/studentreg/profile', array('idUser' => $trainer->trainer)),
                    'organization'=>$trainer->organization->name);
            }
        } else{
            $trainers=false;
        }

        if ($model->isTeacher()) {
            $role = array('teacher' => true,'trainer'=>$trainers);
            $teacher_attributes = Teacher::model()->findByPk($id)->getAttributes(array('corporate_mail','mailActive'));
        } else {
            $role = array('teacher' => false,'trainer'=>$trainers);
        }
        if ($model->isGraduate()){
            $graduateModel=Graduate::model()->findByAttributes(array('id_user'=>$model->id));
            $graduate = $graduateModel?$graduateModel->getAttributes():$graduateModel;
        }
        $data = array_merge($model->attributes, $role, $teacher_attributes, ['review'=>$graduate]);
        echo json_encode($data);
    }

    public function actionGetCountriesList()
    {
        echo AddressCountry::countriesListByLang();
    }

    public function actionGetCitiesList()
    {
        $idCountry=Yii::app()->request->getPost('id');
        echo AddressCity::citiesListByCountry($idCountry);
    }

    public function actionGetCurrentCountryCity()
    {
        echo StudentReg::currentCountryCity();
    }

    public function actionGetCurrentSpecializations()
    {
        echo StudentReg::currentSpecializations();
    }
    
    public function actionGetCurrentCareers()
    {
        echo StudentReg::currentCareers();
    }
    
    public function actionGetTypeahead($query) {
        $models = TypeAheadHelper::getTypeahead($query, 'StudentReg', ['firstName', 'middleName', 'secondName', 'email']);
        $array = ActiveRecordToJSON::toAssocArray($models);
        echo json_encode($array);
    }

    /**
     * Method search user models by parameters
     * @param string $concatOperator - condition to concat different params in search query
     * @return array JSON
     */
    public function actionGetUser($concatOperator = 'AND') {
        $criteria = new CDbCriteria();

        /* getting all model fields */
        $searchFields = array_keys(StudentReg::model()->getAttributes());
        /* preparing criteria */
        foreach ($searchFields as $searchField) {
            $value = Yii::app()->request->getParam($searchField, null);
            if ($value !== null) {
                $criteria->addCondition("$searchField = $value", $concatOperator);
            }
        }

        $models = StudentReg::model()->findAll($criteria);

        echo json_encode(ActiveRecordToJSON::toAssocArray($models));
    }

    public function actionGetSpecializationsList()
    {
        echo SpecializationsGroup::specializationsList();
    }
    
    public function actionGetCareersList()
    {
        echo Careers::careersList();
    }
//    celebre
    public function actionGetProgressData()
    {
        $id = Yii::app()->request->getPost('id', 0);
        $model = RegisteredUser::userById($id);
        $count_full_cell  = 0;
        $count_total_cell = 0; // add $model->startCareers preferSpecializations
        $student_attributes = ['firstName', 'secondName', 'nickname',
                               'birthday', 'email', 'facebook', 'googleplus', 'linkedin',
                                'twitter', 'phone', 'address', 'education',
                                'interests', 'aboutUs', 'aboutMy', 'avatar',
                                'skype', 'country', 'city', 'prev_job', 'passport',
                                'document_issued_date', 'inn', 'passport_issued', 'current_job'];

        foreach ($model->attributes as $key => $attribute){
            if(in_array($key, $student_attributes)) {
                $count_total_cell++;
                if (!empty($attribute)) {
                    $count_full_cell++;
                }
            }
            if($key === 'avatar' && $attribute === 'noname.png') {
                $count_full_cell--;
            }
        }
        if(count($model->startCareers)) {
            $count_full_cell++;
            $count_total_cell++;
        } else {
            $count_total_cell++;
        }
        if(count($model->preferSpecializations)) {
            $count_full_cell++;
            $count_total_cell++;
        } else {
            $count_total_cell++;
        }
        $data=array('count_total_cell'=>$count_total_cell, 'count_full_cell'=>$count_full_cell);
        echo json_encode($data);
    }

    public function actionUploadDocuments($type)
    {
        UserDocuments::model()->uploadUserDocuments($type);
    }

    public function actionRemoveUserDocumentsFile()
    {
        $idFile=Yii::app()->request->getPost('id');
        $model=DocumentsFiles::model()->findByPk($idFile);
        $file=Yii::getpathOfAlias('webroot').'/files/documents/'.Yii::app()->user->getId().'/'.$model->idDocument->type.'/'.$model->file_name;
        if (is_file($file))
            unlink($file);
        $model->delete();
    }

    public function actionRemoveUserDocument()
    {
        $document=UserDocuments::model()->findByPk(Yii::app()->request->getPost('id'));
        foreach ($document->documentsFiles as $file) {
            $file->delete();
        }
        $document->delete();
    }

    public function actionAddReview(){
        $request = Yii::app()->request->getPost('review');
        if ($request){
           $model = Graduate::model()->findByAttributes(array('id_user'=>Yii::app()->user->getId()));
           $model->loadModel($request);
           $model->published = 0;
           if ($model->validate()){
               $model->save();
               echo 'true';

           }
           else{
               echo CJSON::encode(['errors'=>$model->getErrors()]);
           }
        }
        return true;

    }

    public function actionGetDocumentsTypes()
    {
        echo json_encode(ActiveRecordToJSON::toAssocArrayWithRelations(DocumentsTypes::model()->findAll()));
    }

    public function actionSaveDocumentData() {
        function valueNull($value) {
            return !$value?null:$value;
        }

        $result = ['message' => 'OK'];
        $statusCode = 201;
        try {
            $params = array_map("valueNull", $_POST);
            $documents=UserDocuments::model()->findByAttributes(
                array('id_user'=>Yii::app()->user->getId(),'checked'=>UserDocuments::NOT_CHECKED,'type'=>$params['type'])
            );
            if(!$documents) {
                $documents = new UserDocuments();
            }else {
                $documents->updatedAt=new CDbExpression('NOW()');
            }

            $documents->setAttributes($params);
            if($params['issued_date']){
                $date = str_replace('/', '-', $params['issued_date']);
                $documents['issued_date']=date("Y-m-d", strtotime($date));
            }
            $documents->id_user = Yii::app()->user->getId();
            $documents->save();

            if (count($documents->getErrors())) {
                throw new Exception(json_encode($documents->getErrors()));
            }

            if (!$documents->save()) {
                echo json_encode(['status' => 'error', 'message' => array_values($documents->getErrors())]);
            }
        } catch (Exception $error) {
            $statusCode = 500;
            $result = ['message' => 'error', 'reason' => $error->getMessage()];
        }
        $this->renderPartial('//ajax/json', ['statusCode' => $statusCode, 'body' => json_encode($result)]);
    }

    public function actionGetUserDocuments()
    {
        echo json_encode(ActiveRecordToJSON::toAssocArrayWithRelations(
            UserDocuments::model()->with('documentType','documentsFiles')->findAllByAttributes(
                array('id_user'=>Yii::app()->user->getId())
            )
        ));
    }

    public function actionGetEditableDocument()
    {
        $type = Yii::app()->request->getPost('type');
        $document=UserDocuments::model()->findByAttributes(
            array('id_user'=>Yii::app()->user->getId(),'checked'=>UserDocuments::NOT_CHECKED,'type'=>$type)
        );
        if($document) {
            if($document['issued_date']){
                $date = str_replace('-', '/', $document['issued_date']);
                $document['issued_date']=date("d/m/Y", strtotime($date));
            }
            echo json_encode(ActiveRecordToJSON::toAssocArrayWithRelations($document));
        }else {
            echo null;
        }
    }
}
