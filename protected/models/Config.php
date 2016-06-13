<?php

/**
 * This is the model class for table "config".
 *
 * The followings are the available columns in table 'config':
 * @property string $id
 * @property string $param
 * @property string $value
 * @property string $default
 * @property string $label
 * @property string $type
 * @property integer $hidden
 */
class Config extends CActiveRecord
{
    const HIDDEN = 1;
    const VISIBLE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('param, value, default, label, type, hidden', 'required', 'message' => 'Поле не може бути пустим'),
			array('param, type', 'length', 'max'=>128),
			array('label', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, param, value, default, label, type', 'safe', 'on'=>'search'),
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
			'param' => 'Параметр',
			'value' => 'Значення',
			'default' => 'За замовчуванням',
			'label' => 'Опис',
			'type' => 'Тип',
            'hidden' => 'Прихований',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('param',$this->param,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('default',$this->default,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('type',$this->type,true);
        $criteria->addCondition('hidden=0');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Config the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getBaseUrl(){
        return Yii::app()->config->get('baseUrl');
    }

    public static function getBaseUrlWithoutSchema(){
        return Yii::app()->config->get('baseUrlWithoutSchema');
    }

    public static function getAdminEmail(){
        return Yii::app()->config->get('adminEmail');
    }

    public static function getOpenDialogPath(){
        return Yii::app()->config->get('openDialogPath');
    }

    public static function getImagesPath(){
        return Yii::app()->config->get('imagesPath');
    }

    public static function getCommonPath(){
        return Yii::app()->config->get('commonPath');
    }

    public static function getAvatarsPath(){
        return Yii::app()->config->get('avatarsPath');
    }

    public static function getInterpreterServer(){
        return Yii::app()->config->get('interpreterServer');
    }

    public static function getMaintenanceMode(){
        return Yii::app()->config->get('maintenanceMode');
    }

	public static function getCoeffIndependentModule(){
		return Yii::app()->config->get('coeffIndependentModule');
	}

    public static function getExpirationTimeInterval(){
        return Yii::app()->config->get('expirationTimeInterval');
    }

	public static function getAdminId(){
		return (int)Yii::app()->config->get('adminId');
	}

    public static function getDollarRate(){
        return Yii::app()->config->get('dollarRate');
    }

    public static function getChatPath(){
        return Yii::app()->config->get('chatPath');
    }

    public static function getMinLengthResponse(){
        return Yii::app()->config->get('minLengthResponse');
    }

    public static function getMaxLengthResponse(){
        return Yii::app()->config->get('maxLengthResponse');
    }

	public static function getCoeffModuleOffline(){
		return Yii::app()->config->get('coeffModuleOffline');
	}

	public static function getItemsList(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('hidden='.Config::VISIBLE);
        $configs = Config::model()->findAll($criteria);
        $return = array('data' => array());

        foreach ($configs as $record) {
            $row = array();
            $row["param"]["name"] = $record->param;
            $row["id"] = $record->id;
            $row["param"]["link"] = "'".Yii::app()->createUrl("/_teacher/_admin/config/view", array("id"=>$record->id))."'";
            $row["value"] = $record->value;
            $row["label"] = $record->label;
            array_push($return['data'], $row);
        }

        return json_encode($return);
	}

	public static function getServerTimezone(){
		return Yii::app()->config->get('serverTimezone');
	}

	public static function getLectureDurationInHours(){
		return Yii::app()->config->get('lectureDurationInHours');
	}

	public static function offerScenario(){
		return "default";
	}

	public static function getNotifyEmail(){
        return Yii::app()->config->get('notifyMail');
    }
}
