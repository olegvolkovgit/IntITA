<?php

/**
 * This is the model class for table "acc_payment_schema_template".
 *
 * The followings are the available columns in table 'acc_payment_schema_template':
 * @property integer $id
 * @property string $template_name_ua
 * @property string $template_name_ru
 * @property string $template_name_en
 * @property string $description_ua
 * @property string $description_ru
 * @property string $description_en
 * @property integer $id_organization
 */
class PaymentSchemeTemplate extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'acc_payment_schema_template';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('template_name_ua', 'required'),
            // The following rule is used by search().
            array('id, template_name_ua, template_name_ru, template_name_en, description_ua,description_ru, description_en, id_organization', 'safe'),
            // @todo Please remove those attributes that should not be searched.
            array('id, template_name_ua, template_name_ru, template_name_en, description_ua,description_ru, description_en, id_organization', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'schemes' => array(self::HAS_MANY, 'TemplateSchemes', 'id_template', 'order' => 'schemes.pay_count'),
            'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'template_name_ua' => 'назва шаблону ua',
            'template_name_ru' => 'назва шаблону ru',
            'template_name_en' => 'назва шаблону en',
            'description_ua' => 'опис ua',
            'description_ru' => 'опис ru',
            'description_en' => 'опис en',
            'id_organization' => 'ID organization',
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
        $criteria->compare('template_name_ua', $this->template_name_ua, true);
        $criteria->compare('template_name_ru', $this->template_name_ru, true);
        $criteria->compare('template_name_en', $this->template_name_en, true);
        $criteria->compare('description_ua', $this->description_ua, true);
        $criteria->compare('description_ru', $this->description_ru, true);
        $criteria->compare('description_en', $this->description_en, true);
        $criteria->compare('id_organization', $this->id_organization, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PaymentSchemeTemplate the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getSchemaCalculator(EducationForm $educationForm) {
        $schemes= array();

        $param = Yii::app()->session["lg"]?"title_".Yii::app()->session["lg"]:"title_ua";
        foreach ($this->schemes as $scheme){
            $schema = new AdvancePaymentSchema($scheme->discount, $scheme->loan, $scheme->pay_count, $educationForm, $scheme->id, $scheme->schemeName->$param, $scheme->contract);
            array_push($schemes,$schema);
        }

        return $schemes;
    }

    public function getName()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "template_name_" . $lang;
        return CHtml::encode($this->$title)?CHtml::encode($this->$title):CHtml::encode($this->template_name_ua);
    }

    public function getDescription()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "description_" . $lang;
        return CHtml::encode($this->$title)?CHtml::encode($this->$title):CHtml::encode($this->description_ua);
    }

    public function canEditPaymentSchema() {
        if($this->id_organization){
            return Yii::app()->user->model->getCurrentOrganizationId()==$this->id_organization;
        }else{
            return Yii::app()->user->model->isAuditor();
        }
    }
}
