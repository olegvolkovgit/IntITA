<?php

/**
 * This is the model class for table "vc_module".
 *
 * The followings are the available columns in table 'vc_module':
 * @property integer $id_module_revision
 * @property integer $id_parent
 * @property integer $id_module
 * @property integer $id_properties
 *
 * The followings are the available model relations:
 * @property RevisionModuleProperties $properties
 */
class RevisionModule extends CRevisionUnitActiveRecord
{

    private $approveResultCashed = null;
    /**
     * @return string the associated database table name
     */
    
    public function tableName()
    {
        return 'vc_module';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_parent, id_module, id_module_revision, id_properties', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_parent, id_module, id_module_revision, id_properties', 'safe', 'on'=>'search'),
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
            'parent' => array(self::HAS_ONE, 'RevisionModule', ['id_module_revision'=>'id_parent']),
            'properties' => array(self::HAS_ONE, 'RevisionModuleProperties', ['id'=>'id_properties']),
            'moduleLectures' => array(self::HAS_MANY, 'RevisionModuleLecture', 'id_module_revision',
                'order' => 'lecture_order ASC'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_module_revision' => 'Id Module Revision',
            'id_parent' => 'Id Parent',
            'id_module' => 'Id Module',
            'id_properties' => 'Id Properties',
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

        $criteria->compare('id_module_revision',$this->id_module_revision);
        $criteria->compare('id_parent',$this->id_parent);
        $criteria->compare('id_module',$this->id_module);
        $criteria->compare('id_properties',$this->id_properties);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RevisionLecture the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Returns last approved module in branch
     * @param integer $idModule
     * @return RevisionModule|null
     */
    public static function getParentRevisionForModule($idModule) {

        $criteria = new CDbCriteria;
        $criteria->alias = 'vc_module';
        $criteria->condition = 'id_module=' . $idModule;
        $criteria->with = array('properties');
        $criteria->order = 'properties.approve_date DESC';
        $criteria->addCondition('properties.id_user_approved IS NOT NULL');
        $criteria->limit = 1;

        $revisions = RevisionModule::model()->find($criteria);
        return isset($revisions)?$revisions:null;
    }

    /**
     * Returns module QuickUnion structure.
     * If $idCourse specified - returns revisions of this course, else - all revisions
     * @param null|$idModule
     * @return array
     */
    public static function getModulesTree($idModule = null) {
        if ($idModule != null) {
            $allIdList = Yii::app()->db->createCommand()
                ->select('id_module_revision, id_parent')
                ->from('vc_module')
                ->where('id_module='.$idModule)
                ->queryAll();
        } else {
            $allIdList = Yii::app()->db->createCommand()
                ->select('id_module_revision, id_parent')
                ->from('vc_module')
                ->queryAll();
        }

        return RevisionModule::getQuickUnionStructure($allIdList);
    }

    /**
     * Returns a Quick Union Structure of related lectures id.
     * Algorithm based on Quick-Union algorithm
     * http://algs4.cs.princeton.edu/15uf/
     * It is important ot keep tree structure, so here is no optimizations
     *
     * @return array
     */
    private static function getQuickUnionStructure($allIdList) {
        // building union data structure;
        // array key represents the elements's id (id_revision),
        // and array value represents link to root element of this element,
        // if element is root its value equal to key

        $quickUnion = array();
        foreach($allIdList as $item) {
            $quickUnion[$item['id_module_revision']] = ($item['id_parent'] == null ? $item['id_module_revision'] : $item['id_parent']);
        };
        return $quickUnion;
    }
    
    public static function createNewRevision($module, $user) {
        $revModuleProperties = new RevisionModuleProperties();

        $transaction = Yii::app()->db->beginTransaction();
        try {

            $revModuleProperties->initialize($module->title_ua, $module->title_en, $module->title_ru, $user);

            $revModule = new RevisionModule();
            $revModule->id_module = $module->module_ID;
            $revModule->id_properties = $revModuleProperties->id;
            $revModule->saveCheck();

            $module->id_module_revision=$revModule->id_module_revision;
            $module->save();
                
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }


        return $revModule;
    }

    /**
     * Clones $this into new db instance.
     * Returns new module instance or current instance if the module is not cloneable
     * @param $user
     * @return RevisionModule
     * @throws Exception
     */
    public function cloneModule($user) {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $newRevision = new RevisionModule();
            $newRevision->id_parent = $this->id_module_revision;
            $newRevision->id_module = $this->id_module;
            $newProperties = $this->properties->cloneProperties($user);
            $newRevision->id_properties = $newProperties->id;

            $newRevision->saveCheck();

            foreach ($this->moduleLectures as $lecture) {
                $lecture->cloneLecture($newRevision->id_module_revision);
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }

        return $newRevision;
    }

    /**
     * Creates new revision from existing module
     * @param Module $module
     * @param $user
     * @return RevisionModule
     * @throws Exception
     * todo refactor
     */
    public static function createNewRevisionFromModule($module, $user) {

        $revModule = null;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $revModuleProperties = new RevisionModuleProperties();
            $revModuleProperties->title_ua = $module->title_ua;
            $revModuleProperties->title_ru = $module->title_ru;
            $revModuleProperties->title_en = $module->title_en;
            $revModuleProperties->module_img = $module->module_img;
            $revModuleProperties->alias = $module->alias;
            $revModuleProperties->language = $module->language;
            $revModuleProperties->module_price = $module->module_price;
            $revModuleProperties->for_whom = $module->for_whom;
            $revModuleProperties->what_you_learn = $module->what_you_learn;
            $revModuleProperties->what_you_get = $module->what_you_get;
            $revModuleProperties->level = $module->level;
            $revModuleProperties->hours_in_day = $module->hours_in_day;
            $revModuleProperties->days_in_week = $module->days_in_week;
            $revModuleProperties->rating = $module->rating;
            $revModuleProperties->module_number = $module->module_number;
            $revModuleProperties->cancelled = $module->cancelled;
            $revModuleProperties->status = $module->status;
            $revModuleProperties->price_offline = $module->price_offline;
            $revModuleProperties->start_date = new CDbExpression('NOW()');
            $revModuleProperties->id_user_created = $user->getId();
            $revModuleProperties->approve_date = new CDbExpression('NOW()');
            $revModuleProperties->id_user_approved = $user->getId();
            $revModuleProperties->release_date = new CDbExpression('NOW()');
            $revModuleProperties->id_user_released = $user->getId();
            $revModuleProperties->saveCheck();

            $revModule = new RevisionModule();
            $revModule->id_module = $module->module_ID;
            $revModule->id_properties = $revModuleProperties->id;
            $revModule->saveCheck();

            //set actual id_module_revision to regular DB (table module)
            Module::model()->updateByPk($module->module_ID, array('id_module_revision'=>$revModule->id_module_revision));
            // lectures
            foreach ($module->lectures as $key=>$lecture) {
                $revNewModuleLecture = new RevisionModuleLecture();
                $revisionOfCurrentLecture=RevisionLecture::getParentRevisionForLecture($lecture->id);
                if($revisionOfCurrentLecture==null){
                    $revisionOfCurrentLecture = RevisionLecture::createNewRevisionFromLecture($lecture, Yii::app()->user);
//                    $revisionOfCurrentLecture->cloneLecture(Yii::app()->user);
                }
                $revNewModuleLecture->id_lecture_revision = $revisionOfCurrentLecture->id_revision;
                $revNewModuleLecture->id_module_revision = $revModule->id_module_revision;
                $revNewModuleLecture->lecture_order =$key+1;
                $revNewModuleLecture->saveCheck();
            }

            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
        return $revModule;
    }
    

    public function editProperties($params, $user) {

        $filtered = [];
        foreach (RevisionModule::getEditableProperties() as $property) {
            if (isset($params[$property])) {
                $filtered[$property] = $params[$property];
            }
        }

        $this->properties->setAttributes($filtered);
        $this->properties->saveCheck();
        $this->setUpdateDate($user);
    }

    /**
     * Returns list of properties which can be edited
     * @return array
     */
    public static function getEditableProperties() {
        return ['title_ua', 'title_ru', 'title_en','alias','for_whom',
            'what_you_learn','what_you_get','level','hours_in_day','days_in_week','cancelled','status'];
    }

    private function setUpdateDate($user) {
        $this->properties->setUpdateDate($user);
    }

    /**
     * Save module model with error checking
     * @throws RevisionModuleException
     */
    public function saveCheck() {
        if (!$this->save()) {
            throw new RevisionModuleException('400',$this->getValidationErrors());
        }
    }

    public function getValidationErrors() {
        $errors=[];
        foreach($this->getErrors() as $attribute){
            foreach($attribute as $error){
                array_push($errors,$error);
            }
        }
        return $errors[0];
    }
    
}
