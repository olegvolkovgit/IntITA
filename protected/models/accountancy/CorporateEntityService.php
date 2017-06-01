<?php

/**
 * This is the model class for table "acc_corporate_entity_service".
 *
 * The followings are the available columns in table 'acc_corporate_entity_service':
 * @property string $id
 * @property integer $corporateEntityId
 * @property integer $checkingAccountId
 * @property string $serviceId
 * @property string $createdAt
 * @property string $deletedAt
 *
 * The followings are the available model relations:
 * @property CorporateEntity $corporateEntity
 * @property CheckingAccounts $checkingAccount
 * @property Service $service
 */
class CorporateEntityService extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'acc_corporate_entity_service';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('corporateEntityId, checkingAccountId, serviceId', 'required'),
            array('corporateEntityId, checkingAccountId', 'numerical', 'integerOnly' => true),
            array('serviceId', 'length', 'max' => 10),
            array('deletedAt', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, corporateEntityId, checkingAccountId, serviceId, createdAt, deletedAt', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'corporateEntity' => array(self::BELONGS_TO, 'CorporateEntity', 'corporateEntityId'),
            'checkingAccount' => array(self::BELONGS_TO, 'CheckingAccounts', 'checkingAccountId'),
            'service' => array(self::BELONGS_TO, 'Service', 'serviceId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'corporateEntityId' => 'Corporate Entity',
            'checkingAccountId' => 'Checking Account',
            'serviceId' => 'Service',
            'createdAt' => 'Created At',
            'deletedAt' => 'Deleted At',
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
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('corporateEntityId', $this->corporateEntityId);
        $criteria->compare('checkingAccountId', $this->checkingAccountId);
        $criteria->compare('serviceId', $this->serviceId, true);
        $criteria->compare('createdAt', $this->createdAt, true);
        $criteria->compare('deletedAt', $this->deletedAt, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CorporateEntityService the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function createBinding(CorporateEntity $corporateEntity, Service $service, CheckingAccounts $checkingAccount) {
        $model = new CorporateEntityService();
        $model->corporateEntityId = $corporateEntity->id;
        $model->checkingAccountId = $checkingAccount->id;
        $model->serviceId = $service->service_id;
        if ($model->validate()) {
            $model->save(false);
        } else {
            throw new Exception('Validation error');
        }
        return $model;
    }
}
