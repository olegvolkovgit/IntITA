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

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['StudentReg'])) {
            if (isset($_POST['educformOff']) && $_POST['educformOff'] == '1')
                $_POST['StudentReg']['educform'] = 'Онлайн/Офлайн';
            else $_POST['StudentReg']['educform'] = 'Онлайн';

            $model->attributes = $_POST['StudentReg'];
            if ($model->password !== Null){
                $model->password = sha1($model->password);
                $model->password_repeat = sha1($model->password_repeat);
            }

            $getToken = rand(0, 99999);
            $getTime = date("Y-m-d H:i:s");
            $model->token = sha1($getToken . $getTime);

            if (isset($model->avatar)) $model->avatar = CUploadedFile::getInstance($model, 'avatar');
            if ($model->validate()) {
                if (isset($model->avatar)) {
                    Avatar::saveStudentAvatar($model);
                }

                if (Yii::app()->session['lg']) $lang = Yii::app()->session['lg'];
                else $lang = 'ua';
                $model->save();
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
        $paymentsCourses = $model->getPaymentsCourses();
        $paymentsModules = $model->getPaymentsModules();
        
        $owner = false;
        if ($idUser == Yii::app()->user->getId()) {
            $owner = true;
        }

        $this->render("profile", array(
            'dataProvider' => $dataProvider,
            'post' => $model,
            'user' => $user,
            'markProvider' => $markProvider,
            'paymentsCourses' => $paymentsCourses,
            'paymentsModules' => $paymentsModules,
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

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'editProfile-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['educformOff']) && $_POST['educformOff'] == '1')
            $_POST['StudentReg']['educform'] = 'Онлайн/Офлайн';
        else $_POST['StudentReg']['educform'] = 'Онлайн';

        $model->attributes = $_POST['StudentReg'];
        if (isset($model->avatar)) $model->avatar = CUploadedFile::getInstance($model, 'avatar');
        if ($model->validate()) {
            if (isset($model->avatar)) {
                Avatar::saveStudentAvatar($model);
            }

            $model->updateByPk($id, array('firstName' => $_POST['StudentReg']['firstName']));
            $model->updateByPk($id, array('secondName' => $_POST['StudentReg']['secondName']));
            $model->updateByPk($id, array('nickname' => $_POST['StudentReg']['nickname']));
            $model->updateByPk($id, array('birthday' => $_POST['StudentReg']['birthday']));
            $model->updateByPk($id, array('phone' => $_POST['StudentReg']['phone']));
            $model->updateByPk($id, array('address' => $_POST['StudentReg']['address']));
            $model->updateByPk($id, array('education' => $_POST['StudentReg']['education']));
            $model->updateByPk($id, array('educform' => $_POST['StudentReg']['educform']));
            $model->updateByPk($id, array('interests' => $_POST['StudentReg']['interests']));
            $model->updateByPk($id, array('aboutUs' => $_POST['StudentReg']['aboutUs']));
            $model->updateByPk($id, array('aboutMy' => $_POST['StudentReg']['aboutMy']));
            $model->updateByPk($id, array('facebook' => $_POST['StudentReg']['facebook']));
            $model->updateByPk($id, array('googleplus' => $_POST['StudentReg']['googleplus']));
            $model->updateByPk($id, array('linkedin' => $_POST['StudentReg']['linkedin']));
            $model->updateByPk($id, array('vkontakte' => $_POST['StudentReg']['vkontakte']));
            $model->updateByPk($id, array('twitter' => $_POST['StudentReg']['twitter']));
            $model->updateByPk($id, array('skype' => $_POST['StudentReg']['skype']));

            if (isset($_POST['StudentReg']['country'])) {
                $model->updateByPk($id, array('country' => $_POST['StudentReg']['country']));

                if(!empty($_POST['StudentReg']['country'])){
                    $cityId = AddressCity::newUserCity($_POST['StudentReg']['city'], $_POST['cityTitle'], $_POST['StudentReg']['country']);
                    $model->updateByPk($id, array('city' => $cityId));   
                }else{
                    $model->updateByPk($id, array('city' => null));
                }
            }

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (!empty($_POST['StudentReg']['password']) && sha1($_POST['StudentReg']['password']) == sha1($_POST['StudentReg']['password_repeat']))
                $model->updateByPk($id, array('password' => sha1($_POST['StudentReg']['password'])));

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
        if ($model->password == sha1($pass)) {
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
        if ($model->isTeacher()) {
            $role = array('teacher' => true);
        } else {
            $role = array('teacher' => false);
        }
        $data = array_merge($model->attributes, $role);
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

}
