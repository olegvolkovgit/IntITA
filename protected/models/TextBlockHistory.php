<?php

/**
 * This is the model class for table "text_block_history".
 *
 * The followings are the available columns in table 'text_block_history':
 * @property integer $id
 * @property integer $id_block
 * @property integer $id_type
 * @property string $html_block
 * @property string $start_date
 * @property integer $id_user_started
 * @property string $approve_date
 * @property integer $id_user_approved
 * @property string $end_date
 * @property integer $id_user_ended
 * @property string $comment
 */
class TextBlockHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'text_block_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_block, id_type, start_date', 'required'),
			array('id_block, id_type, id_user_started, id_user_approved, id_user_ended', 'numerical', 'integerOnly'=>true),
			array('html_block, approve_date, end_date, comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_block, id_type, html_block, start_date, id_user_started, approve_date, id_user_approved, end_date, id_user_ended, comment', 'safe', 'on'=>'search'),
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
			'id_block' => 'Id Block',
			'id_type' => 'Id Type',
			'html_block' => 'Html Block',
			'start_date' => 'Start Date',
			'id_user_started' => 'Id User Started',
			'approve_date' => 'Approve Date',
			'id_user_approved' => 'Id User Approved',
			'end_date' => 'End Date',
			'id_user_ended' => 'Id User Ended',
			'comment' => 'Comment',
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
		$criteria->compare('id_block',$this->id_block);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('html_block',$this->html_block,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('id_user_started',$this->id_user_started);
		$criteria->compare('approve_date',$this->approve_date,true);
		$criteria->compare('id_user_approved',$this->id_user_approved);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('id_user_ended',$this->id_user_ended);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TextBlockHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Approves model and copy content from approved record into related LectureElement
     * @param $idUser
     * @throws Exception
     */
    public function approve($idUser) {

        $transaction = Yii::app()->db->beginTransaction();
        try {
            $lectureElement = LectureElement::model()->findByPk($this->id_block);
            $lectureElement->html_block = $this->html_block;
            $lectureElement->update(array("html_block"));

            $this->id_user_approved = $idUser;
            $this->approve_date = date(Yii::app()->params['dbDateFormat']);
            $this->update(array('id_user_approved', 'approve_date'));
            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }

    }

    /**
     * Sets end_date and user id;
     * @param $idUser
     * @throws CDbException
     */
    public function setEndDate($idUser) {
        $this->end_date = date(Yii::app()->params['dbDateFormat']);
        $this->id_user_ended = $idUser;
        $this->update(array('end_date', 'id_user_ended'));
    }

    /**
     * Returns last approved model by id_block
     * @param $idBlock
     * @return static
     */
    public static function getLastApproved($idBlock) {
        $criteria = new CDbCriteria(array(
            "condition" => "id_block=:id_block AND approve_date=
			(SELECT MAX(approve_date) FROM text_block_history WHERE id_block=:id_block)",
            "params" => array(":id_block" => $idBlock)
        ));
        return TextBlockHistory::model()->find($criteria);
    }

    /**
     * Returns lasst version of block by id_block
     * @param $idBlock
     * @return static
     */
    public static function getLastEdited($idBlock) {
        $criteria = new CDbCriteria(array(
            "condition" => "id_block=:id_block AND start_date=
			(SELECT MAX(start_date) FROM text_block_history WHERE id_block=:id_block)",
            "params" => array(":id_block" => $idBlock)
        ));
        return TextBlockHistory::model()->find($criteria);
    }

    /**
     * Returns history of block changes in inverse order on start_date field
     * @param $idBlock
     * @return static[]
     */
    public static function getBlockHistory($idBlock) {
        $criteria = new CDbCriteria(array(
            "condition" => "id_block=:id_block",
            "params" => array(":id_block" => $idBlock),
            "order" => "start_date DESC"
        ));
        return TextBlockHistory::model()->findAll($criteria);
    }

    /**
     * Update previous records end_date, creates new record, and returns its instance.
     * @param $id_block
     * @param $idType
     * @param $content
     * @param $userId
     * @return TextBlockHistory
     * @throws Exception
     */
    public static function createNewRecord($id_block, $idType, $content, $userId) {
        // Finds current block without end_date and sets end_date
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $criteria = new CDbCriteria(array(
                "condition" => "id_block=:id_block AND end_date=0",
                "params" => array(":id_block" => $id_block)
            ));

            $oldBlocksHistory = TextBlockHistory::model()->findAll($criteria);
            foreach ($oldBlocksHistory as $block) {
                if ($block->end_date == 0) {
                    $block->setEndDate($userId);
                }
            }

            //new record
            $textBlockHistory = new TextBlockHistory();
            $textBlockHistory->id_block = $id_block;
            $textBlockHistory->id_type = $idType;
            $textBlockHistory->html_block = $content;
            $textBlockHistory->id_user_started = $userId;
            $textBlockHistory->start_date = date(Yii::app()->params['dbDateFormat']);
            $textBlockHistory->save();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }

        return $textBlockHistory;
    }
}
