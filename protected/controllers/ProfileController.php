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

        if (isset($_POST['Response'])) {
            $response->attributes = $_POST["Response"];
            $response->who = Yii::app()->user->id;
            $response->date = date("Y-m-d H:i:s");
            $str = trim($_POST['Response']['text'], chr(194) . chr(160) . chr(32) . " \t\n\r\0\x0B");
            if ($str == '') {
                $response->text = NULL;
            }
            if ($response->validate()) {
                $response->text = trim($response->bbcode_to_html($_POST['Response']['text']), chr(194) . chr(160) . chr(32) . " \t\n\r\0\x0B");
                $response->knowledge = $_POST['Response']['knowledge'];
                $response->behavior = $_POST['Response']['behavior'];
                $response->motivation = $_POST['Response']['motivation'];
                $response->rate = round(($_POST['Response']['knowledge'] + $_POST['Response']['behavior'] + $_POST['Response']['motivation']) / 3);

                $response->who_ip = $_SERVER["REMOTE_ADDR"];

                $response->save();
                $command = Yii::app()->db->createCommand();
                $command->insert('teacher_response', array(
                    'id_teacher'=>$teacher->user_id,
                    'id_response'=>$response->id,
                ));

                Yii::app()->user->setFlash('messageResponse', Yii::t('response', '0386'));
                $this->refresh();
            }
        }

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
}