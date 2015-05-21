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
        $permission = new Permissions();
        if ($permission->checkPermission(Yii::app()->user->getId(), $id, array('edit'))) {
            $editMode = true;
        } else {
            $editMode = false;
        }

        $lecture = Lecture::model()->findByPk($id);

        $criteria = new CDbCriteria();
        $criteria->addCondition('id_lecture='.$id);

        $dataProvider = new CActiveDataProvider('LectureElement');
        $dataProvider->criteria = $criteria;
        $criteria->order = 'block_order ASC';
        $dataProvider->setPagination(array(
                'pageSize' => '200',
            )
        );
        $countBlocks = LectureElement::model()->count('id_lecture = :id', array(':id' => $id));

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
        $model->id_type = '1';
        $model->type = 'text';

        $model->save();
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - up block
    public function actionUpElement()
    {
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');
        //if exists prev element, reorder current and prev elements
        if($order > 1) {
            $this->swapBlocks($idLecture, $order - 1, $order);
        }

        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //reorder blocks on lesson page - down block
    public function actionDownElement(){
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');
        //if exists next element, reorder current and next elements
        if($order < LectureElement::model()->count('id_lecture='.$idLecture)) {
            $this->swapBlocks($idLecture, $order, $order + 1);
        }
        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    //delete block on lesson page
    public function actionDeleteElement(){
        $idLecture = Yii::app()->request->getPost('idLecture');
        $order = Yii::app()->request->getPost('order');

        //delete current block
        LectureElement::model()->deleteAllByAttributes(array('id_lecture' => $idLecture, 'block_order' => $order));

        //reorder elements after deleted block
        $this->reorderBlocks($idLecture, $order);
        // if AJAX request, we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
    }

    public  function reorderBlocks($idLecture, $order){
        //count number of blocks in lecture and increment(because we delete one record in actionDeleteElement)
        $countBlocks = LectureElement::model()->count('id_lecture = :id', array(':id' => $idLecture));
        $countBlocks++;
        //change orders in blocks of lesson after deleted record(block)
        for ($i = $order+1; $i <= $countBlocks; $i++){
            $id = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $i))->id_block;
            LectureElement::model()->updateByPk($id, array('block_order' => $i-1));
        }
    }

    public function swapBlocks($idLecture, $first, $second)
    {
        //find blocks id's for first and second elements
        $firstId = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $first))->id_block;
        $secondId = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $second))->id_block;
        //swap blocks - rewrite block order in DB
        LectureElement::model()->updateByPk($secondId, array('block_order' => $first));
        LectureElement::model()->updateByPk($firstId, array('block_order' => $second));
    }
}