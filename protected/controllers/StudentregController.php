<?php

class StudentRegController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new StudentReg;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['StudentReg']))
        {
            $model->attributes=$_POST['StudentReg'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['StudentReg']))
        {
            $model->attributes=$_POST['StudentReg'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */

    public function actionIndex($tempEmail='',$tempPass='')
    {
        $tab=0;
        $model=new StudentReg('reguser');

        if(isset($_POST['StudentReg']))
        {
            if(is_null($_POST['StudentReg']['firstName']))
                $this->redirect('courses');

            if(isset($_POST['educformOff']) && $_POST['educformOff'] == '1')
                $_POST['StudentReg']['educform']='Онлайн/Офлайн';
            else $_POST['StudentReg']['educform']='Онлайн';

            $model->attributes=$_POST['StudentReg'];
            $getToken=rand(0, 99999);
            $getTime=date("Y-m-d H:i:s");
            $model->token=sha1($getToken.$getTime);
            if($model->validate())
            {
                /*network validation*/
                $networksArray = [];
                $networksArray["facebook"]=$_POST['StudentReg']['facebook'];
                $networksArray["googleplus"]=$_POST['StudentReg']['googleplus'];
                $networksArray["linkedin"]=$_POST['StudentReg']['linkedin'];
                $networksArray["vkontakte"]=$_POST['StudentReg']['vkontakte'];
                $networksArray["twitter"]=$_POST['StudentReg']['twitter'];
                $networkKeys = array_keys($networksArray);
                $networkIndex=0;
                foreach($networksArray as $network){
                    if($network!=''){
                        switch ($networkKeys[$networkIndex]){
                            case "facebook":
                                $netURL='https://www.facebook.com/'.$_POST['StudentReg']['facebook'];
                                break;
                            case "googleplus":
                                $netURL='https://plus.google.com/'.$_POST['StudentReg']['googleplus'];
                                break;
                            case "linkedin":
                                $netURL='https://www.linkedin.com/'.$_POST['StudentReg']['linkedin'];
                                break;
                            case "vkontakte":
                                $netURL='http://vk.com/'.$_POST['StudentReg']['vkontakte'];
                                break;
                            case "twitter":
                                $netURL='https://twitter.com/'.$_POST['StudentReg']['twitter'];
                                break;
                            default:
                                $netURL='https://www.'.$networkKeys[$networkIndex].'.com/'.$_POST['StudentReg'][$networkKeys[$networkIndex]];
                        }
                        if(StudentReg::getCorrectURl($netURL))
                            $model->$networkKeys[$networkIndex] = $netURL;
                        else {
                            $model->addError($networkKeys[$networkIndex],'Ви ввели не коректну сторінку');
                            $tab=1;
                            $hasError=1;
                        }
                    }
                    $networkIndex++;
                }
                if(isset($hasError) && $hasError==1) {
                    for ($net = 0; $net < count($networkKeys); $net++){
                        $model->$networkKeys[$net]=$_POST['StudentReg'][$networkKeys[$net]];
                    }
                }
                /*network validation*/
                if($_FILES["upload"]["size"] > 1024*1024*5)
                {
                    Yii::app()->user->setFlash('avatarmessage',Yii::t('error','0302'));
                }elseif (is_uploaded_file($_FILES["upload"]["tmp_name"]))
                {
                    $ext = substr(strrchr( $_FILES["upload"]["name"],'.'), 1);
                    $_FILES["upload"]["name"]=uniqid().'.'.$ext;
                    copy($_FILES['upload']['tmp_name'], Yii::getpathOfAlias('webroot')."/images/avatars/".$_FILES['upload']['name']);
                    $model->avatar=$_FILES["upload"]["name"];
                }
                if ($model->hasErrors()) {
                    $this->render("studentreg", array('model'=>$model,'tab'=>$tab));
                } else{
                    $model->save();
                    $subject=Yii::t('activeemail','0298');
                    $headers="Content-type: text/plain; charset=utf-8 \r\n" . "From: no-reply@intita.com";
                    $text=Yii::t('activeemail','0299').
                        " ".Yii::app()->params['baseUrl']."/index.php?r=site/AccActivation/view&token=".$model->token."&email=".$model->email;
                    mail($model->email,$subject,$text,$headers);
                    $this->redirect(Yii::app()->createUrl('/site/activationinfo', array('email' => $model->email)));
                }
            } else {
                $this->render("studentreg", array('model'=>$model));
            }
        }else {
            $model->addError('empty', 'Дані не введені');
            $this->render("studentreg", array('model'=>$model, 'tempEmail'=>$tempEmail, 'tempPass'=>$tempPass));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new StudentReg('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['StudentReg']))
            $model->attributes=$_GET['StudentReg'];

        $this->render('admin',array(
            'model'=>$model,
        ));
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
        $model=StudentReg::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param StudentReg $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='student-profile-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function checkAccess($id=1, $right, $code1, $code2)
    {
        if(Yii::app()->user->isGuest){
            throw new CHttpException(403, Yii::t('errors', $code1));
        }
        else{
            $permission = new Permissions();
            if (!$permission->checkPermission(Yii::app()->user->getId(), $id, array($right))) {
                throw new CHttpException(403, Yii::t('errors', $code2));
            }
        }
    }

    public function actionProfile($idUser,$tab=0)
    {
        $model=StudentReg::model()->findByPk($idUser);
        if ($idUser!==Yii::app()->user->getId())
            throw new CHttpException(403, 'Вибачте, Ви не можете переглядати чужий профіль.');
        $letter = new Letters();
        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id'=>$idUser));

        $criteria= new CDbCriteria;
        $criteria->alias = 'consultationscalendar';
        if($teacher)
            $criteria->addCondition('teacher_id='.$teacher->teacher_id);
        else
            $criteria->addCondition('user_id='.$idUser);

        $dataProvider = new CActiveDataProvider('Consultationscalendar', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>100,
            ),
            'sort'=> array(
                'defaultOrder' => 'date_cons DESC',
                'attributes'=>array('date_cons'),
            ),
        ));

        $sentLettersCriteria= new CDbCriteria;
        $sentLettersCriteria->alias = 'letters';
        $sentLettersCriteria->addCondition('sender_id='.$idUser);

        $sentLettersProvider = new CActiveDataProvider('Letters', array(
            'criteria'=>$sentLettersCriteria,
            'pagination'=>array(
                'pageSize'=>100,
            ),
            'sort'=> array(
                'defaultOrder' => 'date DESC',
                'attributes'=>array('date'),
            ),
        ));

        $receivedLettersCriteria= new CDbCriteria;
        $receivedLettersCriteria->alias = 'letters';
        $receivedLettersCriteria->addCondition('addressee_id='.$idUser);

        $receivedLettersProvider = new CActiveDataProvider('Letters', array(
            'criteria'=>$receivedLettersCriteria,
            'pagination'=>array(
                'pageSize'=>100,
            ),
            'sort'=> array(
                'defaultOrder' => 'date DESC',
                'attributes'=>array('date'),
            ),
        ));

        $coursesCriteria= new CDbCriteria;
        $coursesCriteria->alias = 'pay_courses';
        $coursesCriteria->addCondition('id_user='.$idUser);

        $paymentsCourses = new CActiveDataProvider('PayCourses', array(
            'criteria'=>$coursesCriteria,
            'pagination'=>false,
        ));

        $modulesCriteria= new CDbCriteria;
        $modulesCriteria->alias = 'pay_modules';
        $modulesCriteria->addCondition('id_user='.$idUser);

        $paymentsModules = new CActiveDataProvider('PayModules', array(
            'criteria'=>$modulesCriteria,
            'pagination'=>false,
        ));

        $markCriteria= new CDbCriteria;
        $markCriteria->alias = 'response';
        $markCriteria->addCondition('who='.$idUser);
        $markCriteria->addCondition('rate>0');

        $markProvider = new CActiveDataProvider('Response', array(
            'criteria'=>$markCriteria,
            'pagination'=>false,
        ));

        $this->render("studentprofile", array(
            'dataProvider' => $dataProvider,
            'post' => $model,
            'letter'=>$letter,
            'sentLettersProvider'=>$sentLettersProvider,
            'receivedLettersProvider'=>$receivedLettersProvider,
            'tab'=>$tab,
            'paymentsCourses'=>$paymentsCourses,
            'paymentsModules'=>$paymentsModules,
            'markProvider'=>$markProvider,
        ));

    }
    public function actionSendletter()
    {
        $model=StudentReg::model()->findByPk(1);

        if($_POST['submit']) {
            if(!empty($_POST['send_letter'])) {
                $title = $_POST['letterTheme'];
                $mess = $_POST['send_letter'];
                // $to - кому отправляем
                $to = 'Wizlightdragon@gmail.com';
                // $from - от кого
                $from = $model->email;
                // функция, которая отправляет наше письмо.
                mail($to, $title, $mess, "Content-type: text/html; charset=utf-8 \r\n" . "From:" . $from . "\r\n");
                Yii::app()->user->setFlash('messagemail','Ваше повідомлення відправлено');
            }
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
    public function actionEdit()
    {
        if (Yii::app()->user->isGuest)
            throw new CHttpException(403, 'Вибачте, перед редагуванням свого профіля авторизуйтеся.');
        $model =  new StudentReg('edit');

        $this->render("studentprofileedit", array('model'=>$model));

    }
    public function actionRewrite()
    {
        $tab=0;
        $id=Yii::app()->user->id;
        $model=StudentReg::model()->findByPk(Yii::app()->user->id);
        $model->setScenario('edit');

        if(isset($_POST['educformOff']) && $_POST['educformOff'] == '1')
            $_POST['StudentReg']['educform']='Онлайн/Офлайн';
        else $_POST['StudentReg']['educform']='Онлайн';

        $model->attributes=$_POST['StudentReg'];
        if($model->validate()) {
            $model->updateByPk($id, array('firstName' => $_POST['StudentReg']['firstName']));
            $model->updateByPk($id, array('secondName' => $_POST['StudentReg']['secondName']));
            $model->updateByPk($id, array('nickname' => $_POST['StudentReg']['nickname']));
            $model->updateByPk($id, array('birthday' => $_POST['StudentReg']['birthday']));
            $model->updateByPk($id, array('phone' => $_POST['StudentReg']['phone']));
            $model->updateByPk($id, array('phone' => $_POST['StudentReg']['phone']));
            $model->updateByPk($id, array('address' => $_POST['StudentReg']['address']));
            $model->updateByPk($id, array('education' => $_POST['StudentReg']['education']));
            $model->updateByPk($id, array('educform' => $_POST['StudentReg']['educform']));
            $model->updateByPk($id, array('interests' => $_POST['StudentReg']['interests']));
            $model->updateByPk($id, array('aboutUs' => $_POST['StudentReg']['aboutUs']));
            $model->updateByPk($id, array('aboutMy' => $_POST['StudentReg']['aboutMy']));
            if(!empty($_POST['StudentReg']['facebook']))
            {
                $fURL='https://www.facebook.com/'.$_POST['StudentReg']['facebook'];
                if(StudentReg::getCorrectURl($fURL))
                    $model->updateByPk($id, array('facebook' => $fURL));
                else {
                    $model->addError('facebook','Ви ввели не коректну сторінку');
                    $tab=1;
                }
            }
            else  $model->updateByPk($id, array('facebook' => ''));
            if(!empty($_POST['StudentReg']['googleplus']))
            {
                $gURL='https://plus.google.com/'.$_POST['StudentReg']['googleplus'];
                if(StudentReg::getCorrectURl($gURL))
                    $model->updateByPk($id, array('googleplus' => $gURL));
                else {
                    $model->addError('googleplus','Ви ввели не коректну сторінку');
                    $tab=1;
                }
            }
            else  $model->updateByPk($id, array('googleplus' => ''));
            if(!empty($_POST['StudentReg']['linkedin']))
            {
                $lURL='https://www.linkedin.com/'.$_POST['StudentReg']['linkedin'];
                if(StudentReg::getCorrectURl($lURL))
                    $model->updateByPk($id, array('linkedin' => $lURL));
                else {
                    $model->addError('linkedin','Ви ввели не коректну сторінку');
                    $tab=1;
                }
            }
            else  $model->updateByPk($id, array('linkedin' => ''));
            if(!empty($_POST['StudentReg']['vkontakte']))
            {
                $vURL='http://vk.com/'.$_POST['StudentReg']['vkontakte'];
                if(StudentReg::getCorrectURl($vURL))
                    $model->updateByPk($id, array('vkontakte' => $vURL));
                else {
                    $model->addError('vkontakte','Ви ввели не коректну сторінку');
                    $tab=1;
                }
            }
            else  $model->updateByPk($id, array('vkontakte' => ''));
            if(!empty($_POST['StudentReg']['twitter']))
            {
                $tURL='https://twitter.com/'.$_POST['StudentReg']['twitter'];
                if(StudentReg::getCorrectURl($tURL))
                    $model->updateByPk($id, array('twitter' => $tURL));
                else {
                    $model->addError('twitter','Ви ввели не коректну сторінку');
                    $tab=1;
                }
            }
            else  $model->updateByPk($id, array('twitter' => ''));
            if(!empty($_POST['StudentReg']['password'])&& sha1($_POST['StudentReg']['password'])==sha1($_POST['StudentReg']['password_repeat']))
                $model->updateByPk($id, array('password' => sha1($_POST['StudentReg']['password'])));
            if(!empty($_FILES["upload"])) {
                if($_FILES["upload"]["size"] > 1024*1024*5)
                {
                    Yii::app()->user->setFlash('avatarmessage',Yii::t('error','0302'));
                    $this->redirect(Yii::app()->request->baseUrl . '/studentreg/edit');
                }elseif (is_uploaded_file($_FILES["upload"]["tmp_name"])) {
                    $ext = substr(strrchr( $_FILES["upload"]["name"],'.'), 1);
                    $_FILES["upload"]["name"]=uniqid().'.'.$ext;
                    copy($_FILES['upload']['tmp_name'], Yii::getpathOfAlias('webroot')."/images/avatars/".$_FILES['upload']['name']);
                    $model->updateByPk($id, array('avatar' => $_FILES["upload"]["name"]));
                    Yii::app()->user->setFlash('messageedit', 'Оновлено' );
                }
            }
            if ($model->hasErrors()) {
                $this->render("studentprofileedit", array('model'=>$model,'tab'=>$tab));
            } else
                $this->redirect(Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)));
        } else
            $this->render("studentprofileedit", array('model'=>$model));
    }
    public function actionChangepass()
    {
        $modeltest = new StudentReg('changepass');
        if(isset($_POST['ajax']) && $_POST['ajax']==='change-form')
        {
            echo CActiveForm::validate($modeltest);
            Yii::app()->end();
        }
        $id=Yii::app()->user->id;
        $model=StudentReg::model()->findByPk($id);
        $atr = Yii::app()->request->getPost('StudentReg');
        $pass = $atr ['password'];
        if($model->password==sha1($pass)) {
            if(isset($_POST['StudentReg']))
            {
                $model->updateByPk($id, array('password' => sha1($_POST['StudentReg']['new_password'])));
                $this->redirect(Yii::app()->createUrl('studentreg/profile', array('idUser' => Yii::app()->user->getId())));
            }
        }
    }
    public function actionDeleteavatar()
    {
        $id=Yii::app()->user->id;
        $model=StudentReg::model()->findByPk(Yii::app()->user->id);
        if($model->avatar!=='noname.png'){
            unlink(Yii::getpathOfAlias('webroot').'/images/avatars/'.$model->avatar);
            $model->updateByPk($id, array('avatar' => 'noname.png'));
            $this->redirect(Yii::app()->createUrl('studentreg/edit'));
        } else {
            $this->redirect(Yii::app()->createUrl('studentreg/edit'));
        }

    }

    public function actionTimetableProvider($user, $tab)
    {
        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id'=>$user));

        switch ($tab){
            case '1':
                $data = new CActiveDataProvider('Consultationscalendar', array('data' => array()));
                break;
            case '2':
                $criteria= new CDbCriteria;
                $criteria->alias = 'consultationscalendar';
                if($teacher)
                    $criteria->addCondition('teacher_id='.$teacher->teacher_id);
                else
                    $criteria->addCondition('user_id='.$user);

                $data = new CActiveDataProvider('Consultationscalendar', array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>100,
                    ),
                    'sort'=> array(
                        'defaultOrder' => 'date_cons DESC',
                        'attributes'=>array('date_cons'),
                    ),
                ));
                break;
            case '3':
                $data = new CActiveDataProvider('Consultationscalendar', array('data' => array()));
                break;
            case '4':
                $data = new CActiveDataProvider('Consultationscalendar', array('data' => array()));
                break;
        }
        $this->renderPartial('_timetableprovider', array('dataProvider'=>$data,'userId'=>$user));
    }
}
