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
 * @property integer $role
 * @property string $isExtended
 * @property string $network
 * @property string $facebook
 * @property string $googleplus
 * @property string $linkedin
 * @property string $vkontakte
 * @property string $twitter
 * @property string $token
 * @property string $activkey_lifetime
 * @property string $status
 */
class StudentReg extends CActiveRecord
{
    public $password_repeat;
    public $send_letter;
    public $upload;
    public $letterTheme;
    public $network;
    public $new_password;
    public $new_password_repeat;

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
            array('email, password, password_repeat', 'required', 'message'=>Yii::t('error','0268'),'on'=>'reguser'),
            array('email', 'required', 'message'=>Yii::t('error','0268'),'on'=>'recovery,resetemail'),
            array('email', 'email', 'message'=>Yii::t('error','0271'),'on'=>'recovery,resetemail,fromraptoext'),
            array('email', 'authenticateEmail','on'=>'recovery'),
            array('password, new_password_repeat, new_password', 'required', 'message'=>Yii::t('error','0268'),'on'=>'changepass'),
            array('new_password_repeat, new_password', 'required', 'message'=>Yii::t('error','0268'),'on'=>'recoverypass'),
            array('new_password', 'compare', 'compareAttribute'=>'new_password_repeat', 'message'=>Yii::t('error','0269'),'on'=>'changepass,recoverypass'),
            array('password', 'authenticatePass', 'on'=>'changepass'),
            array('email', 'required', 'message'=>'{attribute} '.Yii::t('error','0270'),'on'=>'edit'),
            array('email, password', 'required', 'message'=>Yii::t('error','0268'),'on'=>'repidreg,loginuser'),
            array('email', 'email', 'message'=>Yii::t('error','0271')),
            array('email','unique', 'caseSensitive'=>true, 'allowEmpty'=>true,'message'=>Yii::t('error','0272'),'on'=>'repidreg,reguser,edit,fromraptoext'),
            array('password', 'authenticate','on'=>'loginuser'),
            array('password_repeat', 'passdiff','on'=>'edit'),
            array('birthday', 'date','format' => 'dd/MM/yyyy','message'=>Yii::t('error','0427'),'on'=>'reguser,edit'),
            array('password', 'compare', 'compareAttribute'=>'password_repeat', 'message'=>Yii::t('error','0269'),'on'=>'reguser'),
            array('firstName, secondName, nickname, email, password, education', 'length', 'max'=>255),
            array('birthday', 'length', 'max'=>11),
            array('phone', 'length', 'max'=>15),
            array('educform', 'length', 'max'=>60),
            array('firstName, secondName', 'match', 'pattern'=>'/^[a-zа-яіїёA-ZА-ЯІЇЁ\s\'’]+$/u','message'=>Yii::t('error','0416')),
            array('address, interests, aboutUs,send_letter, role, educform, aboutMy, avatar, network, facebook, googleplus, linkedin, vkontakte, twitter,token,activkey_lifetime, status','safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, firstName, secondName, nickname, birthday, email, password, phone, address, education, educform, interests, aboutUs, password_repeat, middleName,aboutMy, avatar, upload, role', 'safe', 'on'=>'search'),
        );
    }
    public function authenticate($attribute,$params)
    {
        $this->_identity=new UserIdentity($this->email,$this->password);
        if(!$this->_identity->authenticate())
            $this->addError('password',Yii::t('error','0273'));
    }
    public function authenticatePass()
    {
        $model=StudentReg::model()->findByPk(Yii::app()->user->id);
        if(sha1($this->password)!==$model->password)
            $this->addError('password',Yii::t('error','0274'));
    }
    public function authenticateEmail()
    {
        $model=StudentReg::model()->find("email=:e", array('e'=>$this->email));
        if(!$model)
            $this->addError('email',Yii::t('error','0301'));
    }
    public function passdiff()
    {
        $model=StudentReg::model()->findByPk(Yii::app()->user->id);
        if (!empty($model->password)){
            return;
        }
        if (isset($this->password) || isset($this->password_repeat)){
        if($this->password!==$this->password_repeat)
            $this->addError('password',Yii::t('error','0268'));
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
            'email' => Yii::t('regexp', '0242'),
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
            'network' => 'Network',
            'facebook' => 'http://www.facebook.com/',
            'googleplus' => 'https://plus.google.com/',
            'linkedin' => 'http://www.linkedin.com/',
            'vkontakte' => 'http://vk.com/',
            'twitter' => 'http://twitter.com/',
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
        $criteria->compare('network',$this->network,true);
        $criteria->compare('facebook',$this->facebook,true);
        $criteria->compare('googleplus',$this->googleplus,true);
        $criteria->compare('linkedin',$this->linkedin,true);
        $criteria->compare('vkontakte',$this->vkontakte,true);
        $criteria->compare('twitter',$this->twitter,true);
        $criteria->compare('token',$this->token,true);
        $criteria->compare('activkey_lifetime',$this->activkey_lifetime,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('isExtended',$this->isExtended, true);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    protected function beforeSave()
    {
        if($this->password!==Null)
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

    public static function getYearsTermination ($num)
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
    public static function getAdressYears ($birthday,$adress='')
    {
        $brthAdr = $adress;
        if(!empty($adress)&&!empty($birthday)) $brthAdr=$brthAdr.", ";

        $myAge = $birthday;
        $myAge = str_replace("/",".",$myAge);
        $date_a = new DateTime($myAge);
        $date_b = new DateTime();
        $interval = $date_b->diff($date_a);
        if($interval->format("%y")!=='0' ){
            $brthAdr=$brthAdr.$interval->format("%y").' '.StudentReg::getYearsTermination($interval->format("%Y"));
        }
        echo $brthAdr;
    }

    public static function getAboutMy ($aboutMy)
    {
        if($aboutMy)
            echo  '<span class="colorP">'.Yii::t('profile', '0100').'</span>'.$aboutMy;
    }
    public static function getPhone ($phone)
    {
        if($phone)
            echo  '<span class="colorP">'.Yii::t('profile', '0102').'</span>'.$phone;
    }
    public static function getEducation ($education)
    {
        if($education)
            echo  '<span class="colorP">'.Yii::t('profile', '0103').'</span>'.$education;
    }
    public static function getInterests ($interests)
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
    public static function getAboutUs ($aboutUs)
    {
        if($aboutUs)
            echo  '<span class="colorP">'.Yii::t('profile', '0105').'</span>'.$aboutUs;
    }
    public static function getEducform ($educform)
    {
        $user = Teacher::model()->find("user_id=:user_id", array(':user_id'=>Yii::app()->user->id));
        if($educform && !$user)
            echo  '<span class="colorP">'.Yii::t('profile', '0106').'</span>'.$educform;
    }
    public static function getCourses ($courses)
    {
        if($courses)
            echo  '<span class="colorP">'.Yii::t('profile', '0107').'</span>'.$courses;
    }
    public static function getEdForm ($edForm)
    {
        if(isset($edForm) &&
            $edForm == 'Онлайн/Офлайн') {
            $val = 'checked';
        } else{
            $val = '';
        }
        return  $val;
    }
    public static function getNetwork ($post)
    {
        if ($post->facebook || $post->googleplus || $post->linkedin || $post->vkontakte || $post->twitter)
            echo  '<span class="colorP">'."Соціальні мережі:".'</span>';
    }
    public static function getFacebookLink ($link)
    {
        if($link)
            echo  "<span class='networkLink'>"."<a href='$link' target='_blank'>"."Facebook"."</a>"."</span>";
    }
    public static function getGoogleLink ($link)
    {
        if($link)
            echo  "<span class='networkLink'>"."<a href='$link' target='_blank'>"."Google"."</a>"."</span>";
    }
    public static function getLinkedinLink ($link)
    {
        if($link)
            echo  "<span class='networkLink'>"."<a href='$link' target='_blank'>"."Linkedin"."</a>"."</span>";
    }
    public static function getVkLink ($link)
    {
        if($link)
            echo  "<span class='networkLink'>"."<a href='$link' target='_blank'>"."Vkontakte"."</a>"."</span>";
    }
    public static function getTwitterLink ($link)
    {
        if($link)
            echo  "<span class='networkLink'>"."<a href='$link' target='_blank'>"."Twitter"."</a>"."</span>";
    }
    public static function getFacebooknameProfile ($facebook)
    {
        if($facebook){
            $pos = strpos($facebook, 'facebook.com/');
            $val = substr($facebook, $pos+13);
        }
        else $val='';
        return  $val;
    }
    public static function getGooglenameProfile ($googlename)
    {
        if($googlename){
            $pos = strpos($googlename, 'google.com/');
            $val = substr($googlename, $pos+11);
        }
        else $val='';
        return  $val;
    }
    public static function getLinkedinId ($linkedin)
    {
        if($linkedin){
            $pos = strpos($linkedin, 'linkedin.com/');
            $val = substr($linkedin, $pos+13);
        }
        else $val='';
        return  $val;
    }
    public static function getVkId ($vk)
    {
        if($vk){
            $pos = strpos($vk, 'vk.com/');
            $val = substr($vk, $pos+7);
        }
        else $val='';
        return  $val;
    }
    public static function getTwitternameProfile ($twitter)
    {
        if($twitter){
            $pos = strpos($twitter, 'twitter.com/');
            $val = substr($twitter, $pos+12);
        }
        else $val='';
        return  $val;
    }
    public static function getRole ($id)
    {
        $user = Teacher::model()->find("user_id=:user_id", array(':user_id'=>$id));
        if($user)
            return true;
        else return false;
    }
    public static function getProfileRole ($id)
    {
        $user = Teacher::model()->find("user_id=:user_id", array(':user_id'=>$id));
        if($user)
            echo Yii::t('profile', '0241');
        else  echo Yii::t('profile', '0095');
    }
    # Функция для проверки существования страницы
    public static function getCorrectURl ($url)
    {
        # Устанавливаем данные для запроса
        stream_context_set_default(array(
            'http' => array(
                'header' => 'User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:37.0) Gecko/20100101 Firefox/37.0'
            )
        ));

        # Получаем заголовки
        $headers = get_headers($url);

        # Возвращаем результат
        return
            !substr_count($headers[0], '404');
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
