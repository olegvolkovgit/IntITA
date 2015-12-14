<?php

/**
 * This is the model class for table "regextended".
 *
 * The followings are the available columns in table 'regextended':
 * @property integer $regID
 * @property string $language
 * @property string $mainLink
 * @property string $regLink
 * @property string $header
 * @property string $headerFoto
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property string $dateOfBirth
 * @property string $education
 * @property string $tel
 * @property string $email
 * @property string $password
 * @property string $repeatPassword
 * @property string $submitButtonText
 * @property string $chooseFileButton
 * @property string $fileNotChoose
 */
class Regextended extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'regextended';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('language, mainLink, regLink, header, headerFoto, firstName, middleName, lastName, dateOfBirth, education, tel, email, password, repeatPassword, submitButtonText, chooseFileButton, fileNotChoose', 'required'),
            array('language', 'length', 'max' => 2),
            array('mainLink, regLink', 'length', 'max' => 30),
            array('header, headerFoto, firstName, middleName, lastName, dateOfBirth, education, tel, email, password, repeatPassword, submitButtonText, chooseFileButton, fileNotChoose', 'length', 'max' => 50),
            // The following rule is used by search().
            array('regID, language, mainLink, regLink, header, headerFoto, firstName, middleName, lastName, dateOfBirth, education, tel, email, password, repeatPassword, submitButtonText, chooseFileButton, fileNotChoose', 'safe', 'on' => 'search'),
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
            'regID' => 'Reg',
            'language' => 'Language',
            'mainLink' => 'Main Link',
            'regLink' => 'Reg Link',
            'header' => 'Header',
            'headerFoto' => 'Header Foto',
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'dateOfBirth' => 'Date Of Birth',
            'education' => 'Education',
            'tel' => 'Tel',
            'email' => 'Email',
            'password' => 'Password',
            'repeatPassword' => 'Repeat Password',
            'submitButtonText' => 'Submit Button Text',
            'chooseFileButton' => 'Choose File Button',
            'fileNotChoose' => 'File Not Choose',
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

        $criteria->compare('regID', $this->regID);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('mainLink', $this->mainLink, true);
        $criteria->compare('regLink', $this->regLink, true);
        $criteria->compare('header', $this->header, true);
        $criteria->compare('headerFoto', $this->headerFoto, true);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('middleName', $this->middleName, true);
        $criteria->compare('lastName', $this->lastName, true);
        $criteria->compare('dateOfBirth', $this->dateOfBirth, true);
        $criteria->compare('education', $this->education, true);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('repeatPassword', $this->repeatPassword, true);
        $criteria->compare('submitButtonText', $this->submitButtonText, true);
        $criteria->compare('chooseFileButton', $this->chooseFileButton, true);
        $criteria->compare('fileNotChoose', $this->fileNotChoose, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Regextended the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
