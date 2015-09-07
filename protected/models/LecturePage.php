<?php

/**
 * This is the model class for table "lecture_page".
 *
 * The followings are the available columns in table 'lecture_page':
 * @property integer $id
 * @property integer $id_lecture
 * @property integer $page_order
 * @property integer $video
 * @property integer $quiz
 *  @property string $page_title
 */
class LecturePage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lecture_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lecture', 'required'),
			array('id_lecture, page_order, video, quiz', 'numerical', 'integerOnly'=>true),
            array('page_title', 'length', 'max' => 255),

			array('id, id_lecture, page_order, video, quiz, page_title', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_lecture' => 'Id Lecture',
			'page_order' => 'Page Order',
			'video' => 'Video',
			'quiz' => 'Quiz',
            'page_title' => 'Title',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_lecture',$this->id_lecture);
		$criteria->compare('page_order',$this->page_order);
		$criteria->compare('video',$this->video);
		$criteria->compare('quiz',$this->quiz);
        $criteria->compare('page_title',$this->page_title);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder'=>array(
                    'page_order'=>CSort::SORT_ASC,
                )
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LecturePage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getBlocksListById($id){
        $blocks = Yii::app()->db->createCommand()
            ->select('element')
            ->from('lecture_element_lecture_page')
            ->where('page=:page', array(':page'=>$id))
            ->queryAll();
        $result = [];
        for ($i = 0, $count = count($blocks); $i < $count; $i++ ){
            $result[$i] = $blocks[$i]["element"];
        }
        return $result;
    }

    public static function addTextBlock($element, $page){
        Yii::app()->db->createCommand()->insert('lecture_element_lecture_page', array(
            'element'=>$element,
            'page'=>$page,
        ));
    }

    public static function getAccessPages($idLecture, $user){
        /*Sort page_order by Ascending*/
        $criteria= new CDbCriteria;
        $criteria->alias='lecture_page';
        $criteria->order = 'page_order ASC';
        $criteria->condition = 'id_lecture='.$idLecture;

        $pages = LecturePage::model()->findAll($criteria);

        $result = [];
        for ($i = 0, $count = count($pages); $i < $count; $i++ ){
            $result[$i]['order'] = $pages[$i]->page_order;
            $result[$i]['isDone'] = LecturePage::isQuizDone($pages[$i]->quiz, $user);
            $result[$i]['title'] = $pages[$i]->page_title;

            if(LecturePage::isQuizDone($pages[$i]->quiz, $user) == false){
                $result[$i]['isDone'] = true;
                $result = LecturePage::setNoAccessPages($result, $count, $i+1,$pages);
                break;
            } else {

            }
        }
        return $result;
    }

    public static function setNoAccessPages($result, $count, $order, $pages){
        for ($i = $order; $i < $count; $i++ ){
            $result[$i]['order'] = ++$order;
            $result[$i]['isDone'] = false;
            $result[$i]['title'] = $pages[$i]->page_title;
        }
        return $result;
    }

    public static function isQuizDone($quiz, $user){
        if (!$quiz){
            return true;
        }
        if ($user != 0){
            switch(LectureElement::model()->findByPk($quiz)->id_type){
                case '5':
                case '6':
                    return TaskMarks::isTaskDone($user, Task::model()->findByAttributes(array('condition' => $quiz))->id);
                    break;
                case '12':
                case '13':
                    return TestsMarks::isTestDone($user, Tests::model()->findByAttributes(array('block_element' => $quiz))->id);
                    break;
                default:
                    break;
            }
        }
        return false;
    }

    public  static function addNewPage($lecture, $pageOrder){
        $model = new LecturePage();

        $model->id_lecture = $lecture;
        $model->page_order = $pageOrder;

        $model->save();
    }

    public static function addVideo($pageId, $block){

        $model = LecturePage::model()->findByPk($pageId);

        $model->video = $block;
        $model->save();
    }

    public static function deletePage($idLecture, $pageOrder){
        $model = LecturePage::model()->findByAttributes(array('id_lecture' => $idLecture, 'page_order' => $pageOrder));
        $model->delete();
    }

    public static function addQuiz($pageId, $blockElement){
        $model = LecturePage::model()->findByPk($pageId);
        $model->quiz = $blockElement;
        $model->save();
    }

    public static function unableQuiz($pageId){
        if($pageId != 0){
            $model = LecturePage::model()->findByPk($pageId);
            $model->quiz = null;
            return $model->save();
        }
        return false;
    }

    public static function getNextPage($id, $page){
        if ($page >= LectureHelper::getNumberLecturePages($id)) {
            $page = LectureHelper::getNumberLecturePages($id);
        }
        else {
            $page = $page + 1;
        }
        return $page;
    }
}
