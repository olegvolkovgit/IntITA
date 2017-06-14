<?php

/**
 * This is the model class for table "acc_checking_accounts".
 *
 * The followings are the available columns in table 'acc_checking_accounts':
 *
 * @property integer $id
 * @property string $bank_name
 * @property integer $bank_code
 * @property integer $checking_account
 * @property integer $checking_account_order
 * @property integer $corporate_entity
 * @property string $createdAt
 * @property string $deletedAt
 *
 * The followings are the available model relations:
 */
class CheckingAccounts extends CActiveRecord {
    use withToArray;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'acc_checking_accounts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('bank_name, bank_code, checking_account, checking_account_order, corporate_entity', 'required'),
            // The following rule is used by search().
            array('id, bank_name, bank_code, checking_account, checking_account_order, corporate_entity, 
            createdAt, deletedAt', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'corporateEntity' => [self::BELONGS_TO, 'CorporateEntity', 'corporate_entity']
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */

    public function attributeLabels() {
        return array(
            'id' => 'id',
            'bank_name' => 'Банк',
            'bank_code' => 'МФО',
            'checking_account' => 'р/р',
            'corporate_entity' => 'corporate_entity',
            'checking_account_order' => 'checking_account_order',
            'createdAt' => 'createdAt',
            'deletedAt' => 'deletedAt',
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
    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('bank_name', $this->bank_name);
        $criteria->compare('bank_code', $this->bank_code);
        $criteria->compare('checking_account', $this->checking_account);
        $criteria->compare('corporate_entity', $this->corporate_entity);
        $criteria->compare('checking_account_order', $this->checking_account_order);
        $criteria->compare('createdAt', $this->createdAt);
        $criteria->compare('deletedAt', $this->deletedAt);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CheckingAccounts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        return [
            'latestCheckingAccount' => [
                'alias'=>'ca',
                'order' => 'ca.id DESC',
                'condition' => 'ca.deletedAt IS NULL OR ca.deletedAt > NOW()',
                'limit' => 1
            ]
        ];
    }

    /**
     * @param array $data
     * @return $this
     */
    public function updateData($data) {
        $attributes = array_intersect_key($data, $this->getAttributes());
        return $this->createOrUpdateModel($this, $attributes);
    }

    /**
     * @param CheckingAccounts $model
     * @param array $attributes
     * @return CheckingAccounts
     */
    public function createOrUpdateModel($model, $attributes) {
        if ($model) {
            if (empty($attributes['deletedAt'])) {
                $attributes['deletedAt'] = new CDbExpression('DEFAULT');
            }
            if (count($attributes)) {
                $model->setAttributes($attributes, false);
                if ($model->validate()) {
                    $model->save(false);
                } else {
                    return null;
                }
            }
        }
        return $model;
    }

    /**
     * @param array $data
     * @return CheckingAccounts
     */
    public function createCheckingAccount($data) {
        $attributes = array_intersect_key($data, $this->getAttributes());
        $attributes['corporate_entity'] = $data['companyId'];
        $model = new CheckingAccounts();
        return $this->createOrUpdateModel($model, $attributes);
    }
}
