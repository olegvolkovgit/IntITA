<?php

/**
 * This is the model class for table "acc_template_schemas".
 *
 * The followings are the available columns in table 'acc_template_schemas':
 * @property integer $id
 * @property integer $id_template
 * @property integer $discount
 * @property integer $pay_count
 * @property integer $loan
 * @property integer $contract
 */
class TemplateSchemes extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'acc_template_schemas';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_template, pay_count', 'required'),
            array('pay_count', 'numerical', 'integerOnly' => true),
            array('discount, loan', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, discount, id_template, pay_count, loan, contract', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'template' => array(self::BELONGS_TO, 'PaymentSchemeTemplate', 'id_template'),
            'schemeName' => array(self::BELONGS_TO, 'SchemesName', 'pay_count'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_template' => 'id шаблону',
            'discount' => 'відсоток знижки',
            'pay_count' => 'кількість проплат',
            'loan' => 'відсоток кредиту',
            'contract' => 'контракт',
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
        $criteria->compare('id_template', $this->id_template, true);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('pay_count', $this->pay_count);
        $criteria->compare('loan', $this->loan, true);
        $criteria->compare('contract', $this->contract, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TemplateSchemes the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
}
