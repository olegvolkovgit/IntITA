<?php

/**
 * This is the model class for table "vc_text_block_history".
 *
 * The followings are the available columns in table 'vc_text_block_history':
 * @property integer $id
 * @property integer $id_parent
 * @property integer $id_block
 * @property integer $id_type
 * @property string $html_block
 * @property string $start_date
 * @property integer $id_user_created
 * @property string $approve_date
 * @property integer $id_user_approved
 * @property string $end_date
 * @property integer $id_user_cancelled
 */
class TextBlockHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_text_block_history';
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
			array('id_parent, id_block, id_type, id_user_created, id_user_approved, id_user_cancelled', 'numerical', 'integerOnly'=>true),
			array('html_block, approve_date, end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_parent, id_block, id_type, html_block, start_date, id_user_created, approve_date, id_user_approved, end_date, id_user_cancelled', 'safe', 'on'=>'search'),
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
			'id_parent' => 'Id Parent',
			'id_block' => 'Id Block',
			'id_type' => 'Id Type',
			'html_block' => 'Html Block',
			'start_date' => 'Start Date',
			'id_user_created' => 'Id User Created',
			'approve_date' => 'Approve Date',
			'id_user_approved' => 'Id User Approved',
			'end_date' => 'End Date',
			'id_user_cancelled' => 'Id User Cancelled',
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
		$criteria->compare('id_parent',$this->id_parent);
		$criteria->compare('id_block',$this->id_block);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('html_block',$this->html_block,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('id_user_created',$this->id_user_created);
		$criteria->compare('approve_date',$this->approve_date,true);
		$criteria->compare('id_user_approved',$this->id_user_approved);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('id_user_cancelled',$this->id_user_cancelled);

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
	 * Approves current record and copy content to related lecture element
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
		$this->id_user_cancelled = $idUser;
		$this->update(array('end_date', 'id_user_cancelled'));
	}

	/**
	 * Returns last approved model by id_block
	 * @param $idBlock
	 * @return static
	 */
	public static function getLastApproved($idBlock) {
		$criteria = new CDbCriteria(array(
			"condition" => "id_block=:id_block AND approve_date=
			(SELECT MAX(approve_date) FROM vc_text_block_history WHERE id_block=:id_block)",
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
			(SELECT MAX(start_date) FROM vc_text_block_history WHERE id_block=:id_block)",
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
	public static function createNewRecord($id_block, $idType, $content, $userId, $parentId = null) {
		//todo need to retrieve parentId
        $transaction = Yii::app()->db->beginTransaction();
        try {
            // Finds current block without end_date and sets end_date

			$oldBlocksHistory = TextBlockHistory::getUncancelled($id_block);
			foreach ($oldBlocksHistory as $block) {
				if ($block->end_date == 0) {
					$block->setEndDate($userId);
				}
			}

			//new record
			$textBlockHistory = new TextBlockHistory();
            $textBlockHistory->id_parent = $parentId;
			$textBlockHistory->id_block = $id_block;
			$textBlockHistory->id_type = $idType;
			$textBlockHistory->html_block = $content;
			$textBlockHistory->id_user_created = $userId;
			$textBlockHistory->start_date = date(Yii::app()->params['dbDateFormat']);
			$textBlockHistory->save();
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}

		return $textBlockHistory;
	}

	/**
	 * Cancels record. If such record (by id_block) is absent, creates new record and cancels it.
	 * @param $id_block
	 * @param $idType
	 * @param $content
	 * @param $userId
	 * @param null $parentId
	 * @throws Exception
     */
	public static function cancelRecord($id_block, $idType, $content, $userId, $parentId = null) {
		// Finds current block without end_date and sets end_date

		$oldBlocksHistory = TextBlockHistory::getUncancelled($id_block);

		foreach ($oldBlocksHistory as $block) {
			if ($block->end_date == 0) {
				$block->setEndDate($userId);
			}
		}

		if (count($oldBlocksHistory) == 0) {
			TextBlockHistory::createNewRecord($id_block, $idType, $content, $userId, $parentId)
				->setEndDate($userId);
		}
	}

	/**
	 * Returns all uncancelled records
	 * @param $id_block
	 * @return array|mixed|null
     */
	private static function getUncancelled($id_block) {
		$criteria = new CDbCriteria(array(
			"condition" => "id_block=:id_block AND end_date=0",
			"params" => array(":id_block" => $id_block)
		));
		return TextBlockHistory::model()->findAll($criteria);
	}
}
