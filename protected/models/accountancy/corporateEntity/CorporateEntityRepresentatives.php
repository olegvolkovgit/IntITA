<?php

/**
 * This is the model class for table "acc_corporate_entity_representatives".
 *
 * The followings are the available columns in table 'acc_corporate_entity_representatives':
 *
 * @property integer $corporate_entity
 * @property string $corporate_representative
 * @property integer $representative_order
 * @property string $position
 * @property string $position_accusative
 * @property string $createdAt
 * @property string $deletedAt
 *
 * The followings are the available model relations:
 */
class CorporateEntityRepresentatives extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'acc_corporate_entity_representatives';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('corporate_entity, corporate_representative, representative_order, position, position_accusative', 'required'),
            array('position, position_accusative', 'length', 'max' => 100),
            // The following rule is used by search().
            array('corporate_entity, corporate_representative, representative_order, position, position_accusative', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'representative' => array(self::BELONGS_TO, 'CorporateRepresentative', 'corporate_representative'),
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'corporate_entity' => 'corporate_entity',
            'corporate_representative' => 'corporate_representative',
            'representative_order' => 'representative_order',
            'position' => 'position',
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

        $criteria->compare('corporate_entity', $this->corporate_entity);
        $criteria->compare('corporate_representative', $this->corporate_representative);
        $criteria->compare('representative_order', $this->representative_order);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('position_accusative', $this->position_accusative, true);
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
     * @return CorporateRepresentative the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
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
     * @param CorporateEntityRepresentatives $model
     * @param array $attributes
     * @return CorporateEntityRepresentatives
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
     * @return CorporateEntityRepresentatives
     */
    public function createRepresentative($data) {
        $attributes = array_intersect_key($data, $this->getAttributes());
        $attributes['corporate_entity'] = $data['companyId'];
        $model = new CorporateEntityRepresentatives();
        return $this->createOrUpdateModel($model, $attributes);
    }
}
