<?php

/**
 * This is the model class for table "user_last_link".
 *
 * The followings are the available columns in table 'user_last_link':
 * @property integer $id_user
 * @property string $last_link
 *
 * The followings are the available model relations:
 * @property StudentReg $idUser
 */
class UserLastLink extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user_last_link';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_user', 'required'),
            // The following rule is used by search().
            array('id_user, last_link', 'safe', 'on'=>'search'),
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
            'idUser' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_user' => 'Id User',
            'last_link' => 'Last Link',
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

        $criteria->compare('id_user',$this->id_user);
        $criteria->compare('last_link',$this->last_link,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserTrainer the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
