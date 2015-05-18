<?php
/* @var $lecture Lecture*/

class LessonController extends Controller{

    public function initialize($id)
    {
        if ($id != 1){
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
    }

    public function actionIndex($id){
        $this->initialize($id);
        if (Yii::app()->user->getId() == 38){
            $editMode = true;
        } else{
            $editMode = false;
        }
        $lecture = Lecture::model()->findByPk($id);

        $criteria = new CDbCriteria();
        $criteria->addCondition('id_lecture='.$id);

        $dataProvider = new CActiveDataProvider('LectureElement');
        $dataProvider->criteria = $criteria;
        $dataProvider->setPagination(array(
                'pageSize' => '200',
            )
        );
        $countBlocks = LectureElement::model()->findBySql('select block_order from lecture_element where id_lecture=:id order by block_order desc limit 1;', array('id' => $id))->block_order;

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'lecture' => $lecture,
            'editMode' => $editMode,
            'countBlocks' => $countBlocks,
        ));
    }

    public function actionUpdateAjax()
    {
        $data = array();
        $data["day"] = $_POST['dateconsajax'];
        $data["teacherId"] = $_POST['teacherIdajax'];
        $this->renderPartial('_timeConsult', $data, false, true);
    }

    public function actionUnableLesson(){
        $this->render('unableLesson');
    }

    public function filters()
    {
        return array(
            'ajaxOnly + save',
        );
    }

    public function actionSave(){
        $order = substr(Yii::app()->request->getPost('order'), 2);
        $id = Yii::app()->request->getPost('idLecture');
        $model = LectureElement::model()->findByAttributes(array('id_lecture' => $id,'block_order' => $order));
        $model->html_block = Yii::app()->request->getPost('content');
        var_dump($order);
        $model->save();
    }

    public function actionCreateNewBlock(){
        $model = new LectureElement();
        $model->id_lecture = Yii::app()->request->getPost('idLecture');
        $model->block_order = Yii::app()->request->getPost('order');
        $model->html_block = Yii::app()->request->getPost('newTextBlock');
        $model->id_type = 1;
        $model->type = 'text';
        $model->save();
        $this->actionIndex(Yii::app()->request->getPost('idLecture'));
    }

}