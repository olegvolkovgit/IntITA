<?php

/**
 * This is the model class for table "address_country".
 *
 * The followings are the available columns in table 'address_country':
 * @property integer $id
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 *
 * The followings are the available model relations:
 * @property AddressCity[] $addressCities
 * @property StudentReg[] $users
 */
class AddressCountry extends CActiveRecord
{
	const UKRAINE = 1;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'address_country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_ua, title_ru, title_en', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title_ua, title_ru, title_en', 'safe', 'on'=>'search'),
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
			'addressCities' => array(self::HAS_MANY, 'AddressCity', 'country'),
			'users' => array(self::HAS_MANY, 'User', 'country'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title_ua' => 'Title Ua',
			'title_ru' => 'Title Ru',
			'title_en' => 'Title En',
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
		$criteria->compare('title_ua',$this->title_ua,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_en',$this->title_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AddressCountry the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function newUserCountry($oldId, $newTitle){
        $param = "title_". Yii::app()->session["lg"];
        $oldModel = AddressCountry::model()->findByPk($oldId);
        if(!$oldModel){
            $model = new AddressCountry();
            $model->$param = $newTitle;
            if ($model->save()){
                return Yii::app()->db->lastInsertID;
            }
        } else {
            if(strtolower($oldModel->$param) == strtolower($newTitle)){
                return $oldId;
            } else {
                if($exist = AddressCountry::model()->findByAttributes(array($param => $newTitle))){
                    return $exist->id;
                } else {
                    $model = new AddressCountry();
                    $model->$param = $newTitle;
                    if ($model->save()){
                        return Yii::app()->db->lastInsertID;
                    }
                }
            }
        }
        return null;
	}

	public static function countriesList(){
        $countries = AddressCountry::model()->findAll();
        $return = array('data' => array());

        foreach ($countries as $record) {
            $row = array();

            $row["id"] = $record->id;
            $row["title_ua"] = CHtml::encode($record->title_ua);
            $row["title_ru"] = CHtml::encode($record->title_ru);
            $row["title_en"] = CHtml::encode($record->title_en);

            array_push($return['data'], $row);
        }
        return json_encode($return);
	}

	public static function newCountry($titleUa, $titleRu, $titleEn){
        $model = new AddressCountry();

        $model->title_ua = $titleUa;
        $model->title_ru = $titleRu;
        $model->title_en = $titleEn;

        return $model->save();
	}

    public static function countriesByQuery($query){
        $criteria = new CDbCriteria();
        $criteria->select = "id, title_ua, title_ru, title_en";
        $criteria->addSearchCondition('title_ua', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_en', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_ru', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('id', $query, true, "OR", "LIKE");

        $data = AddressCountry::model()->findAll($criteria);
        $result = array();

        foreach ($data as $key => $record) {

            $result["results"][$key]["id"] = $record->id;
            $result["results"][$key]["titleUa"] = CHtml::encode($record->title_ua);
            $result["results"][$key]["titleRu"] = CHtml::encode($record->title_ru);
            $result["results"][$key]["titleEn"] = CHtml::encode($record->title_en);

        }
        return json_encode($result);
    }

	public static function countriesListByLang(){
		$param = "title_".Yii::app()->session["lg"];
		$countries = AddressCountry::model()->findAll();
		$data = array();

		foreach ($countries as $key=>$record) {
			$data[$key]["id"] = $record->id;
			$data[$key]["title"] = $record->$param;
		}
		return json_encode($data);
	}
}
