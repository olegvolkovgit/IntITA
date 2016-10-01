<?php
/**
 * @property string $firstname
 * @property string $lastname
 * @property integer $age
 * @property string $education
 * @property string $phone
 * @property string $email
 * @property string $courses
 */

class TeacherLetter extends CFormModel
{
    public $firstname, $lastname, $age,
           $education, $phone, $email, $courses;
    public function rules()
    {
        return array(
            array('firstname, lastname, phone, email, courses','required','message'=>Yii::t('error','0268')),
            array('age', 'numerical','integerOnly'=>true, 'min'=>16,'max'=>100,"tooSmall" => Yii::t('error','0428'),"tooBig" => Yii::t('error','0428'),'message'=> Yii::t('error','0428')),
            array('firstname, lastname', 'length', 'max'=>35),
            array('phone', 'match','pattern'=>'/^[0-9\+\-\(\)\s]+$/u', 'message'=>Yii::t('error','0429')),
            array('firstname, lastname', 'match', 'pattern'=>'/^[a-zа-яіїёєЄA-ZА-ЯІЇЁ\s\'’]+$/u','message'=>Yii::t('error','0429')),
            array('email','email', 'message'=>Yii::t('error','0271')),
            array('email','length','max'=>50)
        );
    }
    public function attributeLabels()
    {
        return array(
            'firstname' => Yii::t('teachers', '0174'),
            'lastname' => Yii::t('teachers', '0175'),
            'age' => Yii::t('teachers', '0176'),
            'education' => Yii::t('teachers', '0177'),
            'phone' => Yii::t('teachers', '0178'),
            'email' => Yii::t('teachers', '0418'),
            'courses' => Yii::t('teachers', '0179')
        );
    }
    public function sendmail()
    {

    }
}


?>