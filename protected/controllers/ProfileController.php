<?php

class ProfileController extends Controller
{
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($idTeacher)
    {
        $teacher = Teacher::model()->findByPk($idTeacher);
        if(!$teacher->isPrint && !(Yii::app()->user->getId() == $teacher->user_id || StudentReg::isAdmin())){
            throw new CHttpException(403, 'Ти запросив сторінку, доступ до якої обмежений спеціальними правами. Для отримання доступу увійди на сайт з логіном адміністратора або користувача данного профілю.');
        }
        $response = new Response();

        if (Yii::app()->user->getId() == $teacher->user_id) {
            $editMode = 1;
        } else {
            $editMode = 0;
        }

        $dataProvider = $teacher->user->responseDataProvider();

        
        $this->render('index', array(
            'model' => $teacher,
            'editMode' => $editMode,
            'dataProvider' => $dataProvider,
            'response' => $response,
            
        ));
    }

    public function actionSendResponse($idTeacher)
    {
        $teacher = Teacher::model()->findByPk($idTeacher);

        $response = new Response();
        $response->knowledge=Yii::app()->request->getPost('knowledge');
        $response->behavior=Yii::app()->request->getPost('behavior');
        $response->motivation=Yii::app()->request->getPost('motivation');
        $response->text=Yii::app()->request->getPost('text');

        $result=array();

        if($response->knowledge=='' || $response->behavior=='' || $response->motivation==''){
            $result['validation']=false;
            $result['msg']=Yii::t('response', '0385');
            echo json_encode($result);
            return;
        }
        if(strip_tags($response->text)==''){
            $result['validation']=false;
            $result['msg']=Yii::t("response", "0544");
            echo json_encode($result);
            return;
        }

        $response->who = Yii::app()->user->id;
        $response->date = date("Y-m-d H:i:s");
        $str = trim($response->text, chr(194) . chr(160) . chr(32) . " \t\n\r\0\x0B");
        if ($str == '') {
            $response->text = NULL;
        }
        if ($response->validate()) {
            $response->text = trim($response->bbcode_to_html($response->text), chr(194) . chr(160) . chr(32) . " \t\n\r\0\x0B");
            $response->rate = round(($response->knowledge + $response->behavior + $response->motivation) / 3);
            $response->who_ip = $_SERVER["REMOTE_ADDR"];
            $response->save();

            $command = Yii::app()->db->createCommand();
            $command->insert('teacher_response', array(
                'id_teacher'=>$teacher->user_id,
                'id_response'=>$response->id,
            ));

            $result['validation']=true;
            $result['msg']=Yii::t('response', '0386');
            echo json_encode($result);
            return;
        }else{
            $result['validation']=false;
            $result['msg']='Відправити відгук не вдалося';
            echo json_encode($result);
            return;
        }
    }
    public function actionSave()
    {
        if (isset($_POST['id'])) {
            if ($_POST['block'] == 't1' || $_POST['block'] == '1') {
                Teacher::updateFirstText($_POST['id'], $_POST['content']);
            }
            if ($_POST['block'] == 't2' || $_POST['block'] == '2') {
                Teacher::updateSecondText($_POST['id'], $_POST['content']);
            }
        }
        Yii::app()->user->setFlash('success', "Ваш профіль оновлено!");

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function getCourses()
    {
//        $modules = TeacherModule::model()->findAllBySql('select idModule from teacher_module where idTeacher = :idTeacher;',array(':idTeacher' => $this->idTeacher));
        $modules = [1, 3, 7, 10];
        $criteria = new CDbCriteria();
        $criteria->select = 'course';
        $criteria->distinct = true;
        $criteria->addInCondition('course', $modules);
        $criteria->toArray();
        $courses = Module::model()->findAll($criteria);

        return $courses;
    }

    public function actionDeleteAvatar()
    {
        $model = Teacher::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        if ($model->foto_url !== 'noname2.png') {
            unlink(Yii::getpathOfAlias('webroot') . '/images/teachers/' . $model->foto_url);
            $model->updateByPk($model->teacher_id, array('foto_url' => 'noname2.png'));
            $this->redirect(Yii::app()->createUrl('profile/index', array('idTeacher' => $model->teacher_id)));
        } else {
            $this->redirect(Yii::app()->createUrl('profile/index', array('idTeacher' => $model->teacher_id)));
        }

    }

    public function actionActivateMail(){
        $model = Teacher::model()->findByPk(Yii::app()->user->id);
        if (isset($_POST['password']) && isset($_POST['passwordRepeat'])) {
            $model->scenario = 'mailActivation';
            $model->mail_password = $_POST['password'];
            $model->mail_password_repeat = $_POST['passwordRepeat'];
            if($model->validate())
            {
                $model->mail_password = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, Yii::app()->params['secretKey'], $model->mail_password, MCRYPT_MODE_ECB)));
                $model->mailActive = true;
                $model->save(false);
                $mailbox = Mailbox::model()->find('username="'.$model->corporate_mail.'"');
                $mailbox->active = 1;
                $mailbox->setPassword($model->mail_password_repeat);
                $this->redirect(Yii::app()->createUrl('studentreg/profile', array('idUser' => $model->user_id)));
            }
            else
                Yii::app()->end();

        }
        if (!$model->mailActive)
            return $this->render('_mailpassword', array('model'=>$model));
        else
            throw new CHttpException(400,'Електронну скриньку вже активовано!');

    }
}