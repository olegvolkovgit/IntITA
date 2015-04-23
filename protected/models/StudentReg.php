<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $firstName
 * @property string $middleName
 * @property string $secondName
 * @property string $nickname
 * @property string $birthday
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $address
 * @property string $education
 * @property string $educform
 * @property string $interests
 * @property string $aboutUs
 * @property string $aboutMy
 * @property string $role
 * @property boolean $isExtended
 */
class StudentReg extends CActiveRecord
{
    public $password_repeat;
    public $send_letter;
    public $upload;
    public $letterTheme;

    private $_identity;

    public function getDbConnection()
    {
        return Yii::app()->db;
    }
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('firstName, email, password, password_repeat', 'required', 'message'=>'Будь ласка введіть {attribute}.','on'=>'reguser'),
            array('firstName, email', 'required', 'message'=>'{attribute} не може бути пустим.','on'=>'edit'),
            array('email, password', 'required', 'message'=>'Будь ласка введіть {attribute}.','on'=>'repidreg,loginuser,sociallogin'),
            array('email', 'email', 'message'=>'Email не являється правильною {attribute} адресою'),
            array('email','unique', 'caseSensitive'=>true, 'allowEmpty'=>true,'message'=>'Email уже зайнятий','on'=>'repidreg,reguser,edit'),
//            array('avatar', 'file',
//                'allowEmpty'  => true,
//                'maxFiles'   => 1,
//                'maxSize'   => 0.5,
//                'types'   => 'jpg',
//                'tooLarge' => 'Розмір файлу не має перевищувати 512кб',
//                'tooMany' => 'Не можна завантажувати більше 1-го файла',
//                'wrongType' => 'Невірний тип файла',
//                'wrongMimeType' => 'Невірний MIME-тип файла',
//                'on'=>'edit'),
            array('password', 'authenticate','on'=>'loginuser'),
            array('password_repeat', 'passdiff','on'=>'edit'),
            //array('birthday', 'date','format' => 'dd/MM/yyyy','message'=>'Введіть дату народження в форматі дд.мм.рррр'),
            array('password', 'compare', 'compareAttribute'=>'password_repeat', 'message'=>'Паролі не співпадають','on'=>'reguser'),
            array('firstName, secondName, nickname, email, password, education', 'length', 'max'=>255),
            array('birthday', 'length', 'max'=>11),
            array('phone', 'length', 'max'=>15),
            array('educform', 'length', 'max'=>60),
            array('address, interests, aboutUs,send_letter, role, educform, aboutMy, avatar','safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, firstName, secondName, nickname, birthday, email, password, phone, address, education, educform, interests, aboutUs, password_repeat, middleName,aboutMy, avatar, upload, role', 'safe', 'on'=>'search'),
        );
    }
    public function authenticate($attribute,$params)
    {
        $this->_identity=new UserIdentity($this->email,$this->password);
        if(!$this->_identity->authenticate())
            $this->addError('password',"Невірний email або пароль.");
    }
    public function passdiff($pass1,$pass2)
    {
        if (isset($this->password) || isset($this->password_repeat)){
        if($this->password!==$this->password_repeat)
            $this->addError('password','Паролі не співпадають');
        }
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
            'firstName' => Yii::t('regexp', '0160'),
            'middleName'=> 'По-батькові',
            'secondName' => Yii::t('regexp', '0162'),
            'nickname' => Yii::t('regexp', '0163'),
            'birthday' => Yii::t('regexp', '0164'),
            'email' => 'Email',
            'password' => Yii::t('regexp', '0171'),
            'password_repeat' => Yii::t('regexp', '0172'),
            'phone' => Yii::t('regexp', '0165'),
            'address' => Yii::t('regexp', '0166'),
            'education' => Yii::t('regexp', '0167'),
            'educform' => Yii::t('regexp', '0168'),
            'interests' => Yii::t('regexp', '0169'),
            'aboutUs' => 'Звідки про нас?',
            'send_letter'=> 'Повідомлення',
            'letterTheme'=> 'Тема',
            'aboutMy'=> Yii::t('regexp', '0170'),
            'avatar'=> 'Аватар',
            'upload'=> 'Up',
            'role'=>  Yii::t('regexp', '0161'),
        );
    }

    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentity($this->email,$this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
        {
            $duration=3600*24; // 30 days
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        }
        else
            return false;
    }
    public function socialLogin()
    {
        if($this->_identity===null)
        {
            $this->_identity=new SocialUserIdentity($this->email,$this->email);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===SocialUserIdentity::ERROR_NONE)
        {
            $duration=3600*24; // 30 days
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        }
        else
            return false;
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

        $criteria->compare('id',$this->id);
        $criteria->compare('firstName',$this->firstName,true);
        $criteria->compare('middleName',$this->middleName,true);
        $criteria->compare('secondName',$this->secondName,true);
        $criteria->compare('nickname',$this->nickname,true);
        $criteria->compare('birthday',$this->birthday,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('education',$this->education,true);
        $criteria->compare('educform',$this->educform,true);
        $criteria->compare('interests',$this->interests,true);
        $criteria->compare('aboutUs',$this->aboutUs,true);
        $criteria->compare('aboutMy',$this->aboutMy,true);
        $criteria->compare('send_letter',$this->send_letter,true);
        $criteria->compare('avatar',$this->avatar,true);
        $criteria->compare('upload',$this->upload,true);
        $criteria->compare('role',$this->role,true);
        $criteria->compare('isExtended',$this->isExtended, true);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    protected function beforeSave()
    {
        $this->password=sha1($this->password);
        return parent::beforeSave();
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return StudentReg the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getYearsTermination ($num)
    {
        //Оставляем две последние цифры от $num
        $number = substr($num, -2);

        //Если 2 последние цифры входят в диапазон от 11 до 14
        //Тогда подставляем окончание "ЕВ"
        if($number > 10 and $number < 15)
        {
            $term = Yii::t('profile', '0097');
        }
        else
        {

            $number = substr($number, -1);

            if($number == 0) {$term = Yii::t('profile', '0097');}
            if($number == 1 ) {$term = Yii::t('profile', '0098');}
            if($number > 1 ) {$term = Yii::t('profile', '0099');}
            if($number > 4 ) {$term = Yii::t('profile', '0097');}
        }
        return  $term;
    }
    public function getYears ($birthday)
    {
        $myAge = $birthday;
        $myAge = str_replace("/",".",$myAge);
        $date_a = new DateTime($myAge);
        $date_b = new DateTime();
        $interval = $date_b->diff($date_a);
        if($interval->format("%y")!=='0'){
            echo $interval->format("%y").' '.StudentReg::getYearsTermination($interval->format("%Y"));
        }
    }
    public function getAboutMy ($aboutMy)
    {
        if($aboutMy)
            echo  '<span class="colorP">'.Yii::t('profile', '0100').'</span>'.$aboutMy;
    }
    public function getPhone ($phone)
    {
        if($phone)
            echo  '<span class="colorP">'.Yii::t('profile', '0102').'</span>'.$phone;
    }
    public function getEducation ($education)
    {
        if($education)
            echo  '<span class="colorP">'.Yii::t('profile', '0103').'</span>'.$education;
    }
    public function getInterests ($interests)
    {
        if($interests){
            echo  '<span class="colorP">'.Yii::t('profile', '0104').'</span>';
            $interestArray=explode(",", $interests);
            if (!empty($interestArray[0])){
                for ($i = 0; $i < count($interestArray); $i++)
                {
                    echo  '<span class="interestBG">'.$interestArray[$i].' '.'</span>';
                }
            }
        }
    }
    public function getAboutUs ($aboutUs)
    {
        if($aboutUs)
            echo  '<span class="colorP">'.Yii::t('profile', '0105').'</span>'.$aboutUs;
    }
    public function getEducform ($educform)
    {
        if($educform)
            echo  '<span class="colorP">'.Yii::t('profile', '0106').'</span>'.$educform;
    }
    public function getCourses ($courses)
    {
        if($courses)
            echo  '<span class="colorP">'.Yii::t('profile', '0107').'</span>'.$courses;
    }
    public function getEdForm ($edForm)
    {
        if ($edForm=='Офлайн') $val = array('Офлайн');
        if ($edForm=='Онлайн/Офлайн') $val = array('Онлайн','Офлайн');
        if ($edForm=='Онлайн') $val = array('Онлайн');
        return  $val;
    }
    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }

    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }
}
