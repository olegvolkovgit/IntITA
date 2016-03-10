<?php

/**
 * This is the model class for table "vc_block_order_history".
 *
 * The followings are the available columns in table 'vc_block_order_history':
 * @property integer $id
 * @property integer $id_parent
 * @property integer $id_block
 * @property integer $order
 * @property string $start_date
 * @property integer $id_user_created
 * @property string $reject_date
 * @property integer $id_user_rejected
 * @property string $approve_date
 * @property integer $id_user_approved
 * @property string $end_date
 * @property integer $id_user_cancelled
 */
class BlockOrderHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_block_order_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order, start_date', 'required'),
			array('id_parent, id_block, order, id_user_created, id_user_rejected, id_user_approved, id_user_cancelled', 'numerical', 'integerOnly'=>true),
			array('reject_date, approve_date, end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_parent, id_block, order, start_date, id_user_created, reject_date, id_user_rejected, approve_date, id_user_approved, end_date, id_user_cancelled', 'safe', 'on'=>'search'),
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
			'order' => 'Order',
			'start_date' => 'Start Date',
			'id_user_created' => 'Id User Created',
			'reject_date' => 'Reject Date',
			'id_user_rejected' => 'Id User Rejected',
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
		$criteria->compare('order',$this->order);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('id_user_created',$this->id_user_created);
		$criteria->compare('reject_date',$this->reject_date,true);
		$criteria->compare('id_user_rejected',$this->id_user_rejected);
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
	 * @return BlockOrderHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function approve($idUser){
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$lectureElement = LectureElement::model()->findByPk($this->id_block);
			$lectureElement->block_order = $this->order;
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

	public function setEndDate($idUser) {
		$this->end_date = date(Yii::app()->params['dbDateFormat']);
		$this->id_user_cancelled = $idUser;
		$this->update(array('end_date', 'id_user_cancelled'));
	}

	public static function createNewRecord($id_block, $order, $userId, $parentId = null){
		$transaction = Yii::app()->db->beginTransaction();
		try {

			$oldBlocksHistory = BlockOrderHistory::getUncancelled($id_block);
			foreach ($oldBlocksHistory as $block) {
				if ($block->end_date == 0) {
					$block->setEndDate($userId);
				}
			}
			//new record
			$model = new BlockOrderHistory();
			$model->id_parent = $parentId;
			$model->id_block = $id_block;
			$model->order = $order;
			$model->id_user_created = $userId;
			$model->start_date = date(Yii::app()->params['dbDateFormat']);
			$model->save();
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}

		return $model;
	}

	public static function cancelRecord($id_block, $order, $userId, $parentId = null){
		$oldBlocksHistory = BlockOrderHistory::getUncancelled($id_block);
		foreach ($oldBlocksHistory as $block) {
			if ($block->end_date == 0) {
				$block->setEndDate($userId);
			}
		}

		if (count($oldBlocksHistory) == 0) {
			BlockOrderHistory::createNewRecord($id_block, $order, $userId, $parentId)
				->setEndDate($userId);
		}
	}

	private static function getUncancelled($id_block) {
		$criteria = new CDbCriteria(array(
			"condition" => "id_block=:id_block AND end_date=0",
			"params" => array(":id_block" => $id_block)
		));
		return BlockOrderHistory::model()->findAll($criteria);
	}
}
