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
 */
class RevisionModule extends CActiveRecord
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
//            'moduleLectures' => array(self::HAS_MANY, 'RevisionModuleLecture', 'id_module_revision',
//                'order' => 'lecture_order ASC'),
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
     * @param null|$idCourse
     * @return array
     */
    public static function getModulesTree($idCourse = null) {
//        if ($idCourse != null) {
//            $allIdList = Yii::app()->db->createCommand()
//                ->select('id_revision, id_parent')
//                ->from('vc_lecture')
//                ->where('id_module='.$idModule)
//                ->queryAll();
//        } else {
            $allIdList = Yii::app()->db->createCommand()
                ->select('id_module_revision, id_parent')
                ->from('vc_module')
                ->queryAll();
//        }

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
    
}
