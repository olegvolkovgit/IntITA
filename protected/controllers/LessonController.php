<?php
/* @var $lecture Lecture*/

class LessonController extends Controller{

    public function init($id=1)
    {
        if(Yii::app()->user->isGuest){
            throw new CHttpException(403, Yii::t('errors', '0138'));
        }
        else{
            $permission = new Permissions();
            if (!$permission->checkPermission(Yii::app()->user->getId(), $id, array('read'))) {
                throw new CHttpException(403, Yii::t('errors', '0139'));
            }
        }
    }

    public function actionIndex($id = 1){
        $lecture = Lecture::model()->findByPk($id);
        $dataProvider = new CActiveDataProvider('LectureElement');
        $dataProvider->setPagination(array(
                'pageSize' => 27,//Module::model()->findByPk($lecture->idModule)->lesson_count,
            )
        );

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'lecture' => $lecture,

        ));
    }

    public function actionUpdateAjax()
    {
        $data = array();
        $data["day"] = $_POST['dateconsajax'];
        $data["teacherId"] = $_POST['teacherIdajax'];
        $this->renderPartial('_timeConsult', $data, false, true);
    }
}