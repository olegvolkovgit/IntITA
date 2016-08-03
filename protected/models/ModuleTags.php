<?php

/**
 * This is the model class for table "module_tags".
 *
 * The followings are the available columns in table 'module_tags':
 * @property integer $id_module
 * @property integer $id_tag
 *
 * The followings are the available model relations:
 * @property Module $module
 * @property Tags $tag
 */
class ModuleTags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_module, id_tag', 'required'),
			array('id_module, id_tag', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id_module, id_tag', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
//            'module' => array(self::HAS_ONE, 'Module', array('module_ID' => 'id_module')),
            'tag' => array(self::HAS_ONE, 'Tags', array('id' => 'id_tag')),
            'module' => array(self::BELONGS_TO, 'Module', 'id_module')
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tag' => 'Id Tag',
			'id_module' => 'Id Module',
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

        $criteria->compare('id_module',$this->id_module);
        $criteria->compare('id_tag',$this->id_tag,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
	}

    public function activeModules($id)
    {
        $criteria = new CDbCriteria;

        $criteria->addCondition('id_course='.$id);
        $criteria->compare('id_course',$this->id_course);
        $criteria->compare('id_module',$this->id_module);
        $criteria->compare('order',$this->order);
        $criteria->compare('mandatory_modules',$this->mandatory_modules);
        $criteria->compare('price_in_course',$this->price_in_course);
        $criteria->with = array('moduleInCourse');
        $criteria->alias = 'module';
        $criteria->addCondition('cancelled = 0');


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false,
            'sort'=>array(
                'defaultOrder'=>array(
                    'order'=>CSort::SORT_ASC,
                )
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ModuleTags the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey(){
        return array('id_module','id_tag');
    }

	public function editModuleTags($tagsList, $idModule) {
		if(!$tagsList) $tagsList=array();
		$currentTags = [];
		$newTags = [];
		$connection = Yii::app()->db;
		$transaction = $connection->beginTransaction();
		$module=Module::model()->findByPk($idModule);
		$moduleTags=$module->moduleTags;

		foreach ($moduleTags as $moduleTag) {
			array_push($currentTags, $moduleTag->id_tag);
		}
		foreach ($tagsList as $tag) {
			array_push($newTags, $tag['id']);
		}
		$tagsToAdd = array_diff($newTags, $currentTags);
		$tagsToRemove = array_diff($currentTags, $newTags);

		try {
			foreach ($tagsToAdd as $idTag){
					$model = new ModuleTags();
					$model->id_module = $idModule;
					$model->id_tag = $idTag;
					$model->save();
			}
			foreach ($tagsToRemove as $idTag){
				$oldModel=ModuleTags::model()->findByPk(array('id_module'=>$idModule,'id_tag'=>$idTag));
				$oldModel->delete();
			}
			
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}
	}
}
