<?php

/**
 * This is the model class for table "acc_corporate_representative".
 *
 * The followings are the available columns in table 'acc_corporate_representative':
 * @property integer $id
 * @property string $full_name
 * @property string $full_name_accusative
 * @property string $full_name_short
 *
 * The followings are the available model relations:
 * @property CorporateEntity[] corporateEntity
 * @property CorporateEntityRepresentatives[] corporateEntityRepresentatives
 */
class CorporateRepresentative extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'acc_corporate_representative';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, full_name, full_name_accusative, full_name_short', 'required'),
            array('full_name, full_name_accusative, full_name_short', 'length', 'max' => 255),
            // The following rule is used by search().
            array('id, full_name, full_name_accusative, full_name_short', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'corporateEntityRepresentatives' => [self::HAS_MANY, 'CorporateEntityRepresentatives', 'corporate_representative', 'order' => 'representative_order, deletedAt DESC'],
            'corporateEntity' => [self::HAS_MANY, 'CorporateEntity', ['corporate_entity' => 'id'], 'through' => 'corporateEntityRepresentatives']
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'full_name' => 'ПІБ',
            'full_name_accusative' => 'full_name_accusative',
            'full_name_short' => 'full_name_accusative'
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
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('full_name_accusative', $this->full_name_accusative, true);
        $criteria->compare('full_name_short', $this->full_name_short, true);

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

    public static function companyRepresentativesList($params) {
//        $criteria = new CDbCriteria();
//        $criteria->select = 'cr.id, cr.full_name, cer.position, cer.representative_order, ce.title, ce.EDPNOU';
//        $criteria->alias = 'cr';
//        $criteria->join = ' left join acc_corporate_entity_representatives cer on cer.corporate_representative = cr.id';
//        $criteria->join .= ' left join acc_corporate_entity ce on ce.id = cer.corporate_entity';
//        $criteria->addCondition('cer.corporate_representative IS NOT NULL');
//
//        $adapter = new NgTableAdapter('CorporateRepresentative',$params);
//        $adapter->mergeCriteriaWith($criteria);
//        echo  json_encode($adapter->getData());

        $sql = 'SELECT cr.id, cr.full_name, cer.position, cer.representative_order, ce.title, ce.EDPNOU FROM acc_corporate_representative cr
                LEFT JOIN acc_corporate_entity_representatives cer ON cer.corporate_representative = cr.id
                LEFT JOIN acc_corporate_entity ce ON ce.id = cer.corporate_entity
                WHERE cer.corporate_representative IS NOT NULL';
        $representatives = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($representatives as $record) {
            $row = array();
            $row["id"] = $record["id"];
            $row["title"]["name"] = CHtml::encode($record["full_name"]);
            $row["title"]["url"] = Yii::app()->createUrl('/_teacher/_accountant/representative/viewRepresentative',
                array('id' => $record["id"]));
            $row["position"] = $record["position"];
            $row["companies"] = $record["EDPNOU"] . ", " . $record["title"];
            $row["order"] = $record["representative_order"];

            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public static function representativesList($params) {
        $adapter = new NgTableAdapter('CorporateRepresentative', $params);
        return json_encode($adapter->getData());
    }

    public static function representativesByQuery($query) {
        $criteria = new CDbCriteria();
        $criteria->select = "id, full_name";
        $criteria->addSearchCondition('id', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('LOWER(full_name)', strtolower($query), true, "OR", "LIKE");

        $data = CorporateRepresentative::model()->findAll($criteria);

        $result = [];
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->full_name;
        }
        return json_encode($result);
    }

    public function companies() {
        $sql = "SELECT * FROM acc_corporate_entity_representatives WHERE corporate_representative = " . $this->id;
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function addCompany(CorporateEntity $company, $position, $order) {
        if ($company && $position && $order) {
            return Yii::app()->db->createCommand()->insert('acc_corporate_entity_representatives', array(
                'corporate_entity' => $company->id,
                'corporate_representative' => $this->id,
                'representative_order' => $order,
                'position' => $position
            ));
        }
        return false;
    }

    /**
     * Returns concrete CorporateEntityRepresentatives model by corporateEntityId
     * @param $corporateEntityId
     * @return null|CorporateEntityRepresentatives
     */
    public function getConcreteCorporateEntityRepresentative($corporateEntityId) {
        $filtered = array_filter($this->corporateEntityRepresentatives, function ($item) use ($corporateEntityId) {
            return $item->corporate_entity == $corporateEntityId;
        });
        if (count($filtered)) {
            return $filtered[0];
        }
        return null;
    }

    /**
     * Returns concrete CorporateEntityRepresentatives model by corporateEntityId
     * @param $corporateEntityId
     * @return null|CorporateEntityRepresentatives
     */
    public function getConcreteCorporateEntity($corporateEntityId) {
        $filtered = array_filter($this->corporateEntity, function ($item) use ($corporateEntityId) {
            return $item->id == $corporateEntityId;
        });
        if (count($filtered)) {
            return $filtered[0];
        }
        return null;
    }

    public function updateData($data) {
        $attributes = array_intersect_key($data, $this->getAttributes());
        if (count($attributes)) {
            $this->setAttributes($attributes);
            $this->save();
        }
        $companyId = $data['companyId'];
        $corporateEntityRepresentative = $this->getConcreteCorporateEntityRepresentative($companyId);
        $corporateEntityRepresentative->updateData($data);
        return;
    }
}
