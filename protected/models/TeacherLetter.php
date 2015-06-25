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
            array('firstname, lastname, phone, email, courses','required'),
            array('age', 'numerical','integerOnly'=>true),
            array('firstname, lastname', 'length', 'max'=>35),
            array('firstname, lastname', 'match', 'pattern'=>'/^[a-zа-яіёA-ZА-ЯІЁ\s\']+$/u','message'=>'Недопустимі символи!'),
            array('email','email'),
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