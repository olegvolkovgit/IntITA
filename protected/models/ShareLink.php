<?php

/**
 * This is the model class for table "share_link".
 *
 * The followings are the available columns in table 'share_link':
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property string $id_organization
 */
class ShareLink extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'share_link';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, link', 'length', 'max'=>255 ),
            array('name, id_organization', 'required' ),
            array('link', 'safe'),
            array('link','required'),
			// The following rule is used by search().
			array('id, name, link, id_organization', 'safe', 'on'=>'search'),
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
            'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Назва ресурса',
			'link' => 'Посилання',
            'id_organization' => 'Організація',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);
        $criteria->compare('id_organization',$this->id_organization,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShareLink the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function shareLinksList($allLinks){
        $condition=$allLinks?'':'id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        $links = ShareLink::model()->findAll($condition);
        $return = array('data' => array());

        foreach ($links as $record) {
            $row = array();
            $row["id"] = $record->id;
            $row["name"] = CHtml::encode($record->name);
            $row["link"]["title"] = CHtml::encode($record->link);
            $row["link"]["url"] = "'".Yii::app()->createUrl("/_teacher/_supervisor/shareLink/view", array("id"=>$record->id))."'";
            $row["organization"] = $record->organization->name;
            array_push($return['data'], $row);
        }

        return json_encode($return);
	}
}
