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
 * property string $reg_time
 * @property string $avatar
 * @property string $identity
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
            array('facebook, googleplus, linkedin, vkontakte, twitter', 'networkValidation'),
            array('avatar', 'file', 'types' => 'jpg, gif, png, jpeg', 'maxSize' => 1024 * 1024 * 5, 'allowEmpty' => true, 'tooLarge' => Yii::t('error', '0302'), 'on' => 'reguser,edit', 'except' => 'socialLogin'),
            array('email, password, password_repeat', 'required', 'message' => Yii::t('error', '0268'), 'on' => 'reguser'),
            array('email', 'required', 'message' => Yii::t('error', '0268'), 'on' => 'recovery,resetemail'),
            array('email', 'email', 'message' => Yii::t('error', '0271'), 'on' => 'recovery,resetemail,fromraptoext'),
            array('email', 'authenticateEmail', 'on' => 'recovery'),
            array('password, new_password_repeat, new_password', 'required', 'message' => Yii::t('error', '0268'), 'on' => 'changepass'),
            array('new_password_repeat, new_password', 'required', 'message' => Yii::t('error', '0268'), 'on' => 'recoverypass'),
            array('new_password', 'compare', 'compareAttribute' => 'new_password_repeat', 'message' => Yii::t('error', '0269'), 'on' => 'changepass,recoverypass'),
            array('password', 'authenticatePass', 'on' => 'changepass'),
            array('email', 'required', 'message' => '{attribute} ' . Yii::t('error', '0270'), 'on' => 'edit'),
            array('email, password', 'required', 'message' => Yii::t('error', '0268'), 'on' => 'repidreg,loginuser'),
            array('email', 'email', 'message' => Yii::t('error', '0271')),
            array('email', 'unique', 'caseSensitive' => true, 'allowEmpty' => true, 'message' => Yii::t('error', '0272'), 'on' => 'resetemail, repidreg,reguser,edit,fromraptoext, network_identity'),
            array('password', 'authenticate', 'on' => 'loginuser'),
            array('password_repeat', 'passdiff', 'on' => 'edit'),
            array('birthday', 'date', 'format' => 'dd/MM/yyyy', 'message' => Yii::t('error', '0427'), 'on' => 'reguser,edit'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'message' => Yii::t('error', '0269'), 'on' => 'reguser'),
            array('firstName, secondName, nickname, email, password, education', 'length', 'max' => 255),
            array('birthday', 'length', 'max' => 11),
            array('phone', 'match', 'pattern' => '^\+\d{2}\(\d{3}\)\d{3}\d{2}\d{2}$^', 'message' => 'Введіть коректний номер'),
            array('phone', 'length', 'max' => 15),
            array('phone', 'length', 'min' => 15),
            array('educform', 'length', 'max' => 60),
            array('firstName, secondName', 'match', 'pattern' => '/^[a-zа-яіїёA-ZА-ЯІЇЁєЄ\s\'’]+$/u', 'message' => Yii::t('error', '0416')),
            array('address, interests, aboutUs,send_letter, role, educform, aboutMy, avatar, network, facebook, googleplus, linkedin, vkontakte, twitter,token,activkey_lifetime, status, identity', 'safe'),
            // The following rule is used by search().
            array('id, firstName, secondName, nickname, birthday, email, password, phone, address, education, educform, interests, aboutUs, password_repeat, middleName,aboutMy, avatar, upload, role, reg_time, identity', 'safe', 'on' => 'search'),
        );
    }

    public function networkValidation($attribute)
    {
        /*if value not Roman alphabet or url not validation = error*/
        $value = $this->$attribute;
        if (!empty($value)) {
            if (!StudentReg::isNetworkURL($value, $attribute))
                $this->addError($attribute, Yii::t('validation', '0636'));
            else
                if (preg_match('/[^\x20-\x7f]/', $value) || !StudentReg::getCorrectURl($value))
                    $this->addError($attribute, Yii::t('validation', '0636'));
        }
    }

    public function authenticate()
    {
        $this->_identity = new UserIdentity($this->email, $this->password);
        if (!$this->_identity->authenticate())
            $this->addError('password', Yii::t('error', '0273'));
    }

    public function authenticatePass()
    {
        $model = StudentReg::model()->findByPk(Yii::app()->user->id);
        if (sha1($this->password) !== $model->password)
            $this->addError('password', Yii::t('error', '0274'));
    }

    public function authenticateEmail()
    {
        $model = StudentReg::model()->find("email=:e", array('e' => $this->email));
        if (!$model)
            $this->addError('email', Yii::t('error', '0301'));
    }

    public function passdiff()
    {
        $model = StudentReg::model()->findByPk(Yii::app()->user->id);
        if (!empty($model->password)) {
            return;
        }
        if (isset($this->password) || isset($this->password_repeat)) {
            if ($this->password !== $this->password_repeat)
                $this->addError('password', Yii::t('error', '0268'));
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
            'teacher' => array(self::HAS_ONE, 'Teacher', 'user_id'),
            'trainer' => array(self::HAS_ONE, 'TrainerStudent', 'student'),
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
            'middleName' => 'По-батькові',
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
            'send_letter' => 'Повідомлення',
            'letterTheme' => 'Тема',
            'aboutMy' => Yii::t('regexp', '0170'),
            'avatar' => 'Аватар',
            'upload' => 'Up',
            'role' => Yii::t('regexp', '0161'),
            'network' => 'Network:',
            'facebook' => 'Facebook',
            'googleplus' => 'Google+',
            'linkedin' => 'LinkedIn',
            'vkontakte' => 'VK',
            'twitter' => 'Twitter',
            'reg_time' => 'Registration Time',
        );
    }

    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = 3600 * 24; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }

    public function socialLogin()
    {
        if ($this->_identity === null) {
            $this->_identity = new SocialUserIdentity($this->email, $this->email);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === SocialUserIdentity::ERROR_NONE) {
            $duration = 3600 * 24; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
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
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('middleName', $this->middleName, true);
        $criteria->compare('secondName', $this->secondName, true);
        $criteria->compare('nickname', $this->nickname, true);
        $criteria->compare('birthday', $this->birthday, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('education', $this->education, true);
        $criteria->compare('educform', $this->educform, true);
        $criteria->compare('interests', $this->interests, true);
        $criteria->compare('aboutUs', $this->aboutUs, true);
        $criteria->compare('aboutMy', $this->aboutMy, true);
        $criteria->compare('send_letter', $this->send_letter, true);
        $criteria->compare('avatar', $this->avatar, true);
        $criteria->compare('upload', $this->upload, true);
        $criteria->compare('role', $this->role, true);
        $criteria->compare('network', $this->network, true);
        $criteria->compare('facebook', $this->facebook, true);
        $criteria->compare('googleplus', $this->googleplus, true);
        $criteria->compare('linkedin', $this->linkedin, true);
        $criteria->compare('vkontakte', $this->vkontakte, true);
        $criteria->compare('twitter', $this->twitter, true);
        $criteria->compare('token', $this->token, true);
        $criteria->compare('activkey_lifetime', $this->activkey_lifetime, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('reg_time', $this->reg_time, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    protected function beforeSave()
    {
        if ($this->password !== Null)
            $this->password = sha1($this->password);
        $this->reg_time = time();
        return parent::beforeSave();
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return StudentReg the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function getAdressYears($birthday, $adress = '')
    {
        $brthAdr = $adress;
        if (!empty($adress) && !empty($birthday)) $brthAdr = $brthAdr . ", ";

        $myAge = $birthday;
        $myAge = str_replace("/", ".", $myAge);
        $date_a = new DateTime($myAge);
        $date_b = new DateTime();
        $interval = $date_b->diff($date_a);
        if ($interval->format("%y") !== '0') {
            $brthAdr = $brthAdr . $interval->format("%y") . ' ' . CommonHelper::getYearsTermination($interval->format("%Y"));
        }
        return $brthAdr;
    }

    public static function getAboutMy($aboutMy)
    {
        if ($aboutMy)
            return '<span class="colorP">' . Yii::t('profile', '0100') . '</span>' . $aboutMy;
    }

    public static function getPhone($phone)
    {
        if ($phone)
            return '<span class="colorP">' . Yii::t('profile', '0102') . '</span>' . $phone;
    }

    public static function getEducation($education)
    {
        if ($education)
            echo '<span class="colorP">' . Yii::t('profile', '0103') . '</span>' . $education;
    }

    public static function getInterests($interests)
    {
        if ($interests) {
            echo '<span class="colorP">' . Yii::t('profile', '0104') . '</span>';
            $interestArray = explode(",", $interests);
            if (!empty($interestArray[0])) {
                for ($i = 0; $i < count($interestArray); $i++) {
                    echo '<span class="interestBG">' . $interestArray[$i] . ' ' . '</span>';
                }
            }
        }
    }

    public static function getAboutUs($aboutUs)
    {
        if ($aboutUs)
            echo '<span class="colorP">' . Yii::t('profile', '0105') . '</span>' . $aboutUs;
    }

    public static function getEducform($educform)
    {
        $user = Teacher::model()->find("user_id=:user_id", array(':user_id' => Yii::app()->user->id));
        if ($educform && !$user)
            return StudentReg::getUserData($educform, '0106');
    }

    public static function getCourses($courses)
    {
        if ($courses)
            echo '<span class="colorP">' . Yii::t('profile', '0107') . '</span>' . $courses;
    }

    public static function getEdForm($edForm)
    {
        if (isset($edForm) &&
            $edForm == 'Онлайн/Офлайн'
        ) {
            $val = 'checked';
        } else {
            $val = '';
        }
        return $val;
    }

    public static function getFacebooknameProfile($facebook)
    {
        if ($facebook) {
            $pos = strpos($facebook, 'facebook.com/');
            $val = substr($facebook, $pos + 13);
        } else $val = '';
        return $val;
    }

    public static function getGooglenameProfile($googlename)
    {
        if ($googlename) {
            $pos = strpos($googlename, 'google.com/');
            $val = substr($googlename, $pos + 11);
        } else $val = '';
        return $val;
    }

    public static function getLinkedinId($linkedin)
    {
        if ($linkedin) {
            $pos = strpos($linkedin, 'linkedin.com/');
            $val = substr($linkedin, $pos + 13);
        } else $val = '';
        return $val;
    }

    public static function getVkId($vk)
    {
        if ($vk) {
            $pos = strpos($vk, 'vk.com/');
            $val = substr($vk, $pos + 7);
        } else $val = '';
        return $val;
    }

    public static function getTwitternameProfile($twitter)
    {
        if ($twitter) {
            $pos = strpos($twitter, 'twitter.com/');
            $val = substr($twitter, $pos + 12);
        } else $val = '';
        return $val;
    }

    public static function getRole($id)
    {
        $user = Teacher::model()->find("user_id=:user_id", array(':user_id' => $id));
        if ($user)
            return true;
        else return false;
    }

    public static function getProfileRole($id)
    {
        $user = Teacher::model()->find("user_id=:user_id", array(':user_id' => $id));
        if ($user)
            echo Yii::t('profile', '0241');
        else  echo Yii::t('profile', '0095');
    }

    # Функция для проверки существования страницы
    public static function getCorrectURl($url)
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

    public static function isNetworkURL($value, $network)
    {
        $result = false;
        switch ($network) {
            case 'facebook':
                $domainPartPos = strpos($value, 'https://www.facebook.com/');
                if ($domainPartPos !== 0) $domainPartPos = strpos($value, 'http://www.facebook.com/');
                if ($domainPartPos === 0)
                    $result = true;
                break;
            case 'googleplus':
                $domainPartPos = strpos($value, 'https://plus.google.com/');
                if ($domainPartPos !== 0) $domainPartPos = strpos($value, 'http://plus.google.com/');
                if ($domainPartPos === 0)
                    $result = true;
                break;
            case 'linkedin':
                $domainPartPos = strpos($value, 'https://www.linkedin.com/');
                if ($domainPartPos !== 0) $domainPartPos = strpos($value, 'http://www.linkedin.com/');
                if ($domainPartPos === 0)
                    $result = true;
                break;
            case 'vkontakte':
                $domainPartPos = strpos($value, 'http://vk.com/');
                if ($domainPartPos !== 0) $domainPartPos = strpos($value, 'https://vk.com/');
                if ($domainPartPos === 0)
                    $result = true;
                break;
            case 'twitter':
                $domainPartPos = strpos($value, 'https://twitter.com/');
                if ($domainPartPos !== 0) $domainPartPos = strpos($value, 'http://twitter.com/');
                if ($domainPartPos === 0)
                    $result = true;
                break;
            default:
                $result = false;
        }
        return $result;
    }

    public static function isNewNetwork($network, $profile, $model)
    {
        $result = false;
        switch ($network) {
            case 'facebook':
                if ($model->facebook != $profile)
                    $result = true;
                break;
            case 'googleplus':
                if ($model->googleplus != $profile)
                    $result = true;
                break;
            case 'linkedin':
                if ($model->linkedin != $profile)
                    $result = true;
                break;
            case 'vkontakte':
                if ($model->vkontakte != $profile)
                    $result = true;
                break;
            case 'twitter':
                if ($model->twitter != $profile)
                    $result = true;
                break;
            default:
                $result = false;
        }
        return $result;
    }

    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password, $this->password);
    }

    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }

    public function avatarPath(){
        if ($this->avatar != '')
            return StaticFilesHelper::createAvatarsPath($this->avatar);
        else return StaticFilesHelper::createAvatarsPath('noname.png');
    }

    public function getDataProfile()
    {
        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id' => $this->id));
        $criteria = new CDbCriteria;
        $criteria->alias = 'consultationscalendar';
        if ($teacher)
            $criteria->addCondition('teacher_id=' . $teacher->teacher_id);
        else
            $criteria->addCondition('user_id=' . $this->id);

        $dataProvider = new CActiveDataProvider('Consultationscalendar', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => 'date_cons DESC',
                'attributes' => array('date_cons'),
            ),
        ));

        return $dataProvider;
    }

    public function getTeachersResponseId()
    {
        $teacherResponse = Yii::app()->db->createCommand()
            ->select('id_response')
            ->from('teacher_response')
            ->where('id_teacher=:id', array(':id' => $this->id))
            ->queryAll();
        $result = [];
        for ($i = 0, $count = count($teacherResponse); $i < $count; $i++) {
            $result[$i] = $teacherResponse[$i]["id_response"];
        }
        return $result;
    }

    public function responseDataProvider()
    {
        $responsesIdList = $this->getTeachersResponseId();

        $criteria = new CDbCriteria();
        $criteria->alias = 'response';
        $criteria->order = 'date DESC';
        $criteria->condition = "is_checked = 1";
        $criteria->addInCondition('id', $responsesIdList);

        $dataProvider = new CActiveDataProvider('Response');
        $dataProvider->criteria = $criteria;
        $dataProvider->setPagination(array(
                'pageSize' => 5,
            )
        );
        return $dataProvider;
    }

    public function getMarkProviderData()
    {
        $markCriteria = new CDbCriteria;
        $markCriteria->alias = 'response';
        $markCriteria->addCondition('who=' . $this->id);
        $markCriteria->addCondition('rate>0');

        $markProvider = new CActiveDataProvider('Response', array(
            'criteria' => $markCriteria,
            'pagination' => false,
        ));

        return $markProvider;
    }

    public static function getUserNamePayment($id)
    {
        if ($id) {
            $model = StudentReg::model()->findByPk($id);
            if ($model) {
                if ($model->secondName == '' && $model->firstName == '') {
                    return $model->email;
                } else {
                    return $model->secondName . " " . $model->firstName . ", " . $model->email;
                }
            }
        }
    }

    public function getTeacherId()
    {
        $teacherId = $this->teacher;
        if($teacherId)
        return $teacherId->teacher_id;
    }

    public static function findLikeEmail($userEmail)
    {

        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('email', $userEmail);
        $result = StudentReg::model()->findAll($criteria);

        return $result;
    }

    public function getTeacherModel()
    {
        return $this->teacher;
    }

    public function isAccountant()
    {
        $sql = 'SELECT COUNT(id_user) FROM user_accountant WHERE id_user=' . $this->id.' and end_date IS NULL';
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return ($result != 0) ? true : false;
    }

    public function isTeacher()
    {
        return Teacher::model()->exists('user_id=' . $this->id);
    }

    public static function getUserName($id)
    {
        $model = StudentReg::model()->findByPk($id);
        $name = $model->firstName . " " . $model->secondName;
        return trim($name);
    }

    public function userName()
    {
        $name = $this->firstName . " " . $this->secondName;
        return trim($name);
    }

    public function userNameWithEmail()
    {
        $name = $this->firstName . " " . $this->secondName;
        if ($name == "") {
            return $this->email;
        } else {
            return trim($name. ", ".$this->email);
        }
    }

    public static function getRoleString($id)
    {
        $model = StudentReg::model()->findByPk($id);
        if ($model->isAdmin()) {
            return 'адмін';
        }
        if ($model->isAccountant()) {
            return 'бухгалтер';
        }
        if ($model->isTeacher()) {
            return 'викладач';
        }

        return 'студент';
    }

    public static function getUserInfo()
    {
        $criteria = new CDbCriteria();
        $criteria->select = array('id', 'firstName', 'secondName', 'email');
        $criteria->toArray();
        $count = StudentReg::model()->count();
        $info = Studentreg::model()->findAll($criteria);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$info[$i]["id"]] = $info[$i]["email"] . "; " . $info[$i]["firstName"] . " " . $info[$i]["secondName"];
        }
        return $result;
    }

    public static function isAdmin()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = StudentReg::model()->findByPk(Yii::app()->user->getId());
        $sql = 'SELECT COUNT(id_user) FROM user_admin WHERE id_user=' . $user->id.' and end_date IS NULL';
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return ($result != 0) ? true : false;
    }

    public static function canAddConsultation()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = StudentReg::model()->findByPk(Yii::app()->user->getId());
        return $user->isStudent();
    }

    public function isStudent()
    {
        if ($this->isAdmin() || $this->isAccountant() || $this->isTeacher()) {
            return false;
        } else {
            return true;
        }
    }

    public static function generateUsersList()
    {
        $users = StudentReg::model()->findAll();
        $count = count($users);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $users[$i]->id;
            $result[$i]['alias'] = $users[$i]->firstName . " " . $users[$i]->secondName . ", " . $users[$i]->email;
        }
        return $result;
    }

    public static function isHasAccessFileShare()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = StudentReg::model()->findByPk(Yii::app()->user->getId());
        if ($user->isAdmin() || $user->isTeacher()) {
            return true;
        }
        return false;
    }

    public static function canAddResponse()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = StudentReg::model()->findByPk(Yii::app()->user->getId());
        return $user->isStudent();
    }

    public static function linkInMouseLine()
    {
        if (Yii::app()->user->isGuest)
            return "href='#form'";
        else return "";
    }

    public static function getUserTitle($idUser)
    {
        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id' => $idUser));

        if ($teacher)
            $result = Yii::t('profile', '0715');
        else
            $result = Yii::t('profile', '0129');
        return $result;
    }

    public function getTrainer()
    {
        $trainer = null;
        $criteria = new CDbCriteria();
        $criteria->alias = 'trainer_student';
        $criteria->addCondition('student = :student');
        $criteria->params = array(':student' => $this->id);

        $result = TrainerStudent::model()->find($criteria);
        if ($result) {
            $criteria = new CDbCriteria();
            $criteria->alias = 'teacher';
            $criteria->addCondition('teacher_id = :teacher_id');
            $criteria->params = array(':teacher_id' => $result->trainer);
            $trainer = Teacher::model()->find($criteria);
        }

        if ($trainer)
            return $trainer->teacher_id;
        else return null;
    }

    public static function getStudentWithoutTrainer()
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'user';
        $criteria->join = 'LEFT JOIN trainer_student ON trainer_student.student = user.id';
        $criteria->addCondition('trainer_student.student IS NULL');
        $result = StudentReg::model()->findAll($criteria);

        if ($result)
            return $result;
        else return null;
    }

    public static function getUserWithTrainer()
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'user';
        $criteria->join = 'LEFT JOIN trainer_student ON trainer_student.student = user.id';
        $criteria->addCondition('trainer_student.student = user.id');
        $result = StudentReg::model()->findAll($criteria);

        if ($result)
            return $result;
        else return null;
    }

    public function getLink($name)
    {
        $title = strtolower($name);
        if ($this->$title)
            return "<span class='networkLink'>" . "<a href=" . $this->$title . " target='_blank'>" . $name . "</a>" . "</span>";
    }

    public static function getUserData($data, $tProfile)
    {
        if ($data) {
            return '<span class="colorP">' . Yii::t('profile', $tProfile) . '</span>' . $data;
        }
    }

    public static function getProfileLinkByRole($id, $dp)
    {
        if (!StudentReg::model()->exists('id=:user', array(':user' => $dp->user_id))) {
            $result = Yii::t('profile', '0716');
            return $result;
        }
        $teacher = Teacher::model()->find("user_id=:user_id", array(':user_id' => $id));
        if ($teacher) {
            if (StudentReg::model()->exists('id=:user', array(':user' => $dp->user_id))) {
                $result = StudentReg::model()->findByPk($dp->user_id)->firstName . " " . StudentReg::model()->findByPk($dp->user_id)->secondName;
                if ($result == ' ')
                    $result = StudentReg::model()->findByPk($dp->user_id)->email;
            } else {
                $result = Teacher::getTeacherFirstName($dp->teacher_id) . " " .
                    Teacher::getTeacherLastName($dp->teacher_id);
            }
            return CHtml::link($result,array("/studentreg/profile", "idUser" => $dp->user_id),array("target"=>"_blank"));
        } else {
            $result = Teacher::getTeacherFirstName($dp->teacher_id) . " " .
                Teacher::getTeacherLastName($dp->teacher_id);
            return CHtml::link($result,array("/profile/index", "idTeacher" => $dp->teacher_id),array("target"=>"_blank"));
        }
    }

    public static function getNameEmail()
    {
        if (Yii::app()->user->isGuest) {
            $nameEmail = '';
        } else {
            $user = StudentReg::model()->findByPk(Yii::app()->user->id);
            $nameEmail = '&name=' . $user->firstName . '&email=' . $user->email;
        }
        return $nameEmail;
    }

    public static function getNetwork($post)
    {
        if ($post->facebook || $post->googleplus || $post->linkedin || $post->vkontakte || $post->twitter)
            return '<span class="colorP">' . Yii::t('user', '0779') . '</span>';
    }

    public static function getNickname($post)
    {
        if ($post->nickname == '')
            return '<span class="nameNAN">[' . Yii::t('regexp', '0163') . ']</span>';
        else return $post->nickname;
    }

    public static function getLastName($post)
    {
        if ($post->secondName == '')
            return '<span class="nameNAN">[' . Yii::t('regexp', '0162') . ']</span>';
        else return $post->secondName;
    }

    public static function getName($post)
    {
        if ($post->firstName == '')
            return '<span class="nameNAN">[' . Yii::t('regexp', '0160') . ']</span>';
        else return $post->firstName;
    }

    public static function getStatusInfo($post)
    {
        if ($post->firstName == '' && $post->secondName == '' && $post->nickname == '') {
            return '<span class="nameNAN">[' . Yii::t('regexp', '0163') . ']<br>[' . Yii::t('regexp', '0160') . ']<br>[' . Yii::t('regexp', '0162') . ']</span>';
        } else {
            return  '<span class="statusColor">'.$post->nickname.'</span><br>'.$post->firstName.'<br>'.$post->secondName;
        }
    }

    public function getPaymentsModules()
    {
        $modulesCriteria = new CDbCriteria;
        $modulesCriteria->alias = 'pay_modules';
        $modulesCriteria->addCondition('id_user=' . $this->id);
        $paymentsModules = new CActiveDataProvider('PayModules', array(
            'criteria' => $modulesCriteria,
            'pagination' => false,
        ));
        return $paymentsModules;
    }

    public function getPaymentsCourses()
    {
        $coursesCriteria = new CDbCriteria;
        $coursesCriteria->alias = 'pay_courses';
        $coursesCriteria->addCondition('id_user=' . $this->id);

        $paymentsCourses = new CActiveDataProvider('PayCourses', array(
            'criteria' => $coursesCriteria,
            'pagination' => false,
        ));

        return $paymentsCourses;
    }

    public function getSentLettersData()
    {
        $sentLettersCriteria = new CDbCriteria;
        $sentLettersCriteria->alias = 'letters';
        $sentLettersCriteria->addCondition('sender_id=' . $this->id);

        $sentLettersProvider = new CActiveDataProvider('Letters', array(
            'criteria' => $sentLettersCriteria,
            'pagination' => array(
                'pageSize' => 100,
            ),
            'sort' => array(
                'defaultOrder' => 'date DESC',
                'attributes' => array('date'),
            ),
        ));
        return $sentLettersProvider;
    }

    public function getReceivedLettersData()
    {
        $receivedLettersCriteria = new CDbCriteria;
        $receivedLettersCriteria->alias = 'letters';
        $receivedLettersCriteria->addCondition('addressee_id=' . $this->id);

        $receivedLettersProvider = new CActiveDataProvider('Letters', array(
            'criteria' => $receivedLettersCriteria,
            'pagination' => array(
                'pageSize' => 100,
            ),
            'sort' => array(
                'defaultOrder' => 'date DESC',
                'attributes' => array('date'),
            ),
        ));
        return $receivedLettersProvider;
    }

    public function hasCabinetAccess()
    {
        return $this->isTeacher() || $this->isAdmin() || $this->isAccountant();
    }


    public static function userLetterReceivers()
    {
        return StudentReg::model()->findAll(
            array('condition' => 'role<>0 and id<>' . Yii::app()->user->getId() . ' and id<>1', 'order' => 'id'));
    }

    public static function receivers()
    {
        return StudentReg::model()->findAll(
            array('condition' => 'role<>0 and id<>' . Yii::app()->user->getId() . ' and id<>1', 'order' => 'id'));
    }

    public function receivedMessages(){
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 'm';
        $criteria->order = 'm.id_message DESC';
        $criteria->join = 'JOIN message_receiver r ON r.id_message = m.id_message';
        $criteria->addCondition('r.id_receiver =:id');
        $criteria->addCondition('r.deleted IS NULL');
        $criteria->params = array(':id' => $this->id);

        return UserMessages::model()->findAll($criteria);
    }

    public function newReceivedMessages(){
        $criteria = new CDbCriteria();
        $criteria->alias = 'm';
        $criteria->order = 'm.id_message DESC';
        $criteria->join = 'LEFT JOIN message_receiver r ON r.id_message = m.id_message';
        $criteria->addCondition ('r.deleted IS NULL AND r.read IS NULL and r.id_receiver ='.$this->id);

        return UserMessages::model()->findAll($criteria);
    }

    public function sentMessages(){
        $criteria = new CDbCriteria();
        $criteria->alias = 'um';
        $criteria->join = 'LEFT JOIN messages as m ON um.id_message = m.id';
        $criteria->order = 'm.create_date DESC';
        $criteria->addCondition ('m.sender = '.$this->id);

        return UserMessages::model()->findAll($criteria);
    }

    /**
     * @param $current integer - id current user (is not included into receivers list)
     * @return string - json for typeahead field in new user message form
     */
    public static function usersEmailArray($current){
        $data = Yii::app()->db->createCommand("SELECT secondName, firstName, middleName, email  FROM user WHERE id<>".$current)
            ->queryAll();

        $result = [];
        foreach ($data as $row){
            $result[] = implode(" ", $row);
        }

        return json_encode($result);
    }

    public function getNameOrEmail()
    {
        if (!empty($this->firstName) || !empty($this->secondName))
            return $this->firstName . ' ' . $this->secondName;
        else return $this->email;
    }

    public static function adminsList()
    {
        $sql = 'select * from user inner join user_admin on user.id = user_admin.id_user';
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        if ($result)
            return $result;
        else return [];
    }

    public static function accountantsList()
    {
        $sql = 'select * from user inner join user_accountant on user.id = user_accountant.id_user';
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        if ($result)
            return $result;
        else return [];
    }

    public static function studentsList() {
        $sql = 'select * from user inner join user_student on user.id = user_student.id_user';
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        if ($result)
            return $result;
        else return [];
    }

    public static function getStudentsList($startDate, $endDate) {

        $sql = 'select concat(IFNULL(user.firstName, ""), " ", IFNULL(user.secondName, "")), user.email, user_student.start_date from user inner join user_student on user.id = user_student.id_user ';

        if (isset($startDate) && isset($endDate)){
            $sql .= " WHERE DATE(user_student.start_date) BETWEEN " . "'$startDate'". " AND " . "'$endDate';";
        }
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();
            foreach($record as $field) {
                array_push($row, $field);
            }
            array_push($return['data'], $row);
        }

        echo json_encode($return);
    }

    public static function teachersList()
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'user';
        $criteria->join = 'LEFT JOIN teacher ON teacher.user_id = user.id';
        $criteria->addCondition('teacher.user_id = user.id');
        return StudentReg::model()->findAll($criteria);
    }

    /**
     * @param $query string - query from typeahead
     * @return string - json for typeahead field in user manage page (cabinet, add)
     */
    public static function usersWithoutAdmins($query)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "secondName, firstName, middleName, email";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN user_admin u ON u.id_user = s.id';
        $criteria->addCondition('u.id_user IS NULL');

        $data = StudentReg::model()->findAll($criteria);

        $result = [];
        foreach ($data as $model) {
            $result[]["value"] = $model->secondName . " " . $model->firstName . " " . $model->middleName . ", " . $model->email;
        }
        return json_encode($result);
    }

    /**
     * @param $query string - query from typeahead
     * @return string - json for typeahead field in user manage page (cabinet, add)
     */
    public static function usersWithoutAccountants($query)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "secondName, firstName, middleName, email";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN user_accountant u ON u.id_user = s.id';
        $criteria->addCondition('u.id_user IS NULL');

        $data = StudentReg::model()->findAll($criteria);

        $result = [];
        foreach ($data as $model) {
            $result[]["value"] = $model->secondName . " " . $model->firstName . " " . $model->middleName . ", " . $model->email;
        }
        return json_encode($result);
    }

    public function addAdmin()
    {
        if (Yii::app()->db->createCommand()->insert('user_admin', array(
            'id_user' => $this->id,
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function addAccountant()
    {
        if (Yii::app()->db->createCommand()->insert('user_accountant', array(
            'id_user' => $this->id,
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function cancelAdmin()
    {
        if (Yii::app()->db->createCommand()->update('user_admin', array(
            'end_date'=>date('Y-m-d H:i:s'),
        ), 'id_user=:id', array(':id'=>$this->id))) {
            return true;
        } else {
            return false;
        }
    }

    public function cancelAccountant()
    {
        if (Yii::app()->db->createCommand()->update('user_accountant', array(
            'end_date'=>date('Y-m-d H:i:s'),
        ), 'id_user=:id', array(':id'=>$this->id))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $query string - query from typeahead
     * @return string - json for typeahead field in user manage page (cabinet, add)
     */
    public static function allUsers($query, $id)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "id, secondName, firstName, middleName, email";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");

        $data = StudentReg::model()->findAll($criteria);

        $result = array();
        foreach ($data as $key=>$model) {
            if($model->id != $id) {
                $name = $model->secondName . " " . $model->firstName . " " . $model->middleName;
                $result["results"][$key]["id"] = $model->id;
                $result["results"][$key]["value"] =  ($name != "")?$name.", ".$model->email:$model->email;
            }
        }
        return json_encode($result);
    }

    public function deletedMessages(){
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 'm';
        $criteria->order = 'm.id_message DESC';
        $criteria->join = 'JOIN message_receiver r ON r.id_message = m.id_message';
        $criteria->addCondition('r.id_receiver =:id');
        $criteria->addCondition('r.deleted IS NOT NULL');
        $criteria->params = array(':id' => $this->id);

        return UserMessages::model()->findAll($criteria);
    }

    public function getSenders(){
        $criteria = new CDbCriteria();
        $criteria->alias = 'u';
        $criteria->join = ' LEFT JOIN message_receiver as r ON r.id_receiver = u.id';
        $criteria->join .= ' LEFT JOIN messages as m ON r.id_message = m.id';
        $criteria->group = 'm.sender';
        $criteria->distinct = true;
        $criteria->order = 'm.create_date DESC';
        $criteria->addCondition ('r.id_receiver='.$this->id.' and u.id = m.sender');

        return StudentReg::model()->findAll($criteria);
    }
}
