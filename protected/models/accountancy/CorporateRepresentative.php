<?php

/**
 * This is the model class for table "acc_corporate_representative".
 *
 * The followings are the available columns in table 'acc_corporate_representative':
 * @property integer $id
 * @property string $full_name
 *
 * The followings are the available model relations:
 */
class CorporateRepresentative extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'acc_corporate_representative';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('full_name', 'required'),
            array('full_name', 'length', 'max' => 255),
            // The following rule is used by search().
            array('id, full_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'full_name' => 'ПІБ',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('full_name', $this->full_name, true);

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
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function companyRepresentativesList($params)
    {
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

        $sql = 'select cr.id, cr.full_name, cer.position, cer.representative_order, ce.title, ce.EDPNOU from acc_corporate_representative cr
                left join acc_corporate_entity_representatives cer on cer.corporate_representative = cr.id
                left join acc_corporate_entity ce on ce.id = cer.corporate_entity
                where cer.corporate_representative IS NOT NULL';
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

    public static function representativesList($params)
    {
//        $params['extraParams'] = ['relation->id.company_id' => ''];
        $adapter = new NgTableAdapter('CorporateRepresentative',$params);
        return  json_encode($adapter->getData());
    }

    public static function representativesByQuery($query)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "id, full_name";
        $criteria->addSearchCondition('id', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('full_name', $query, true, "OR", "LIKE");

        $data = CorporateRepresentative::model()->findAll($criteria);

        $result = [];
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->full_name;
        }
        return json_encode($result);
    }

    public function companies()
    {
        $sql = "SELECT * FROM acc_corporate_entity_representatives WHERE corporate_representative = " . $this->id;
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function addCompany(CorporateEntity $company, $position, $order)
    {
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
}
