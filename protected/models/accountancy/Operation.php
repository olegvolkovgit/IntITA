<?php
/**
 * This is the model class for table "acc_operation".
 *
 * The followings are the available columns in table 'acc_operation':
 * @property integer $id
 * @property string $date_create
 * @property integer $user_create
 * @property integer $type_id
 * @property string $summa
 *
 * The followings are the available model relations:
 * @property OperationType $type
 */
class Operation extends CActiveRecord
{
    public $invoicesList;

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_operation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_create, type_id, summa', 'required'),
			array('user_create, type_id', 'numerical', 'integerOnly'=>true),
			array('summa', 'length', 'max'=>10),
			// The following rule is used by search().
			array('id, date_create, user_create, type_id, summa', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'OperationType', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_create' => 'Дата',
			'user_create' => 'Користувач',
			'type_id' => 'Тип',
			'summa' => 'Сума',
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
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('user_create',$this->user_create);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('summa',$this->summa,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => '50',
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Operation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function addOperation($summa, $user, $type, $invoicesListId, $externalSource){

        switch ($type){
            case '1' :
                $model = new AgreementOperation();
                $model->perform($summa, $user, $type, $invoicesListId, $externalSource);
                break;
            case '2' :
                $model = new InvoiceOperation();
                $model->perform($summa, $user, $type, $invoicesListId, $externalSource);
                break;
            default:
                break;
        }
//        $model->summa = $summa;
//        $model->user_create = $user;
//        $model->type_id = $type;
//        $model->invoicesList = Invoice::getInvoiceListById($invoicesListId);
//
//        $transaction = Yii::app()->db->beginTransaction();
//        try
//        {
//            if ($model->save()){
//                $model->addInvoices($invoicesListId);
//                $createDate = Operation::model()->findByPk($model->id)->date_create;
//                if(!ExternalPays::addNewExternalPay($model, $createDate, $externalSource)){
//                    throw new \application\components\Exceptions\FinanceException('External pay is failed!');
//                }
//                if (!$model->addInternalPays($model->invoicesList, $createDate, $model->type_id)){
//                    throw new \application\components\Exceptions\FinanceException('Internal pay is failed!');
//                }
//                Invoice::setInvoicesPayDate($model->invoicesList, $createDate);
//                $transaction->commit();
//            } else {
//                throw new \application\components\Exceptions\FinanceException('Adding operation is failed!');
//            }
//        }
//        catch(Exception $e)
//        {
//            $transaction->rollback();
//            throw new \application\components\Exceptions\FinanceException('Операцію не додано! '.$e->getMessage());
//        }
        //if we not receive an exception, so we have good transaction
        return true;
    }

    public function addInvoices($invoicesList){
        if(!empty($invoicesList)){
            foreach($invoicesList as $invoice){
                Yii::app()->db->createCommand()->insert('acc_operation_invoice', array(
                    'id_operation'=>$this->id,
                    'id_invoice'=>$invoice,
                ));
            }
        }else{
            return false;
        }
        return true;
    }

    public function addInternalPays($invoicesList, $createDate, $operationTypeId){
        if(!empty($invoicesList)){
            foreach($invoicesList as $invoice){
                if(!InternalPays::addNewInternalPay($invoice, $this->user_create, $createDate, $operationTypeId)){
                    return false;
                }
            }
        }else{
            return false;
        }
        return true;
    }


}
