<?php

/**
 * This is the model class for table "newsletters".
 *
 * The followings are the available columns in table 'newsletters':
 * @property integer $id
 * @property string $type
 * @property string $recipients
 * @property string $subject
 * @property string $text
 * @property string $newsletter_email
 * @property integer $created_by
 * @property integer $id_organization
 *
 * The followings are the available model relations:
 * @property Organization $idOrganization
 * @property User $createdBy
 */



class Newsletters extends CActiveRecord implements ITask
{

    use loadFromRequest;

    public $email = null;
	/**
	 * @return string the associated database table name
	 */

	public function tableName()
	{
		return 'newsletters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, subject, text, newsletter_email', 'required'),
			array('created_by, id_organization', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>128),
			array('id, type, recipients, subject, text, created_by, id_organization newsletter_email', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{

		return array(
			'idOrganization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'recitients' => 'Recitients',
			'subject' => 'Subject',
			'text' => 'Text',
			'created_by' => 'Created By',
			'id_organization' => 'Id Organization',
			'newsletter_email' => 'Newsletters Email',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('recitients',$this->recitients,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('id_organization',$this->id_organization);
		$criteria->compare('newsletter_email',$this->newsletter_email);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Newsletters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function startSend()
    {
        foreach ($this->getMailList() as $item){
            $this->sendMail($item);
            sleep(1);
        }
    }

    private function getMailList()
    {
        $mailList = [];
        switch ($this->type) {
            case "roles":
                foreach (unserialize($this->recipients) as $role) {
                    if ($role == 'coworkers'){
                        $users = Teacher::model()->with(['user'])->find('t.end_date IS NULL AND user.cancelled=0');
                        if (isset($models)){
                            foreach ($users as $user){
                                array_push($mailList, $user->user->email);
                            }
                        }
                    }
                    else {
                        $_role = Role::getInstance($role);
                        $criteria = new CDbCriteria();
                        $criteria->with = ['activeMembers'];
                        $users = $_role->getMembers($criteria);
                        if (isset($users)) {
                            foreach ($users as $user) {
                                array_push($mailList, $user->activeMembers->email);
                            }
                        }
                    }
                }
                break;
            case "allUsers":
                $users = StudentReg::model()->with(['student'])->findAll('cancelled=0 AND id_organization='.$this->id_organization);
                if (isset($users)) {
                    foreach ($users as $user) {
                        array_push($mailList, $user->email);
                    }
                }
                break;
            case "users":
                $mailList = unserialize($this->recipients);
                break;
            case "groups":
                $criteria = new CDbCriteria();
                $criteria->with = array('user','group');
                $criteria->addInCondition('group.id',unserialize($this->recipients));
                $criteria->addCondition('end_date IS NULL');
                $criteria->addCondition('graduate_date IS NULL');
                $models = OfflineStudents::model()->findAll($criteria);
                if (isset($models)) {
                    foreach ($models as $user) {
                        array_push($mailList, $user->user->email);
                    }
                }
                break;
            case "subGroups":
                $criteria = new CDbCriteria();
                $criteria->with = array('user','subgroupName');
                $criteria->addInCondition('subgroupName.id',unserialize($this->recipients));
                $criteria->addCondition('end_date IS NULL');
                $criteria->addCondition('graduate_date IS NULL');
                $models = OfflineStudents::model()->findAll($criteria);
                if (isset($models)) {
                    foreach ($models as $user) {
                        array_push($mailList, $user->user->email);
                    }
                }
                break;
            case "emailsFromDatabase":
                $criteria = new CDbCriteria();
                if(intval($this->recipients)===0){
                    $criteria->distinct = true;
                    $criteria->select = "email";
                }else{
                    $criteria->addCondition('category='.$this->recipients);
                }
                $models = UsersEmailDatabase::model()->findAll($criteria);
                if (isset($models)) {
                    foreach ($models as $user) {
                        array_push($mailList, $user->email);
                    }
                }
                break;
        }
        return array_unique($mailList);
    }

    private function sendMail($recipients){
        $fromName = 'IntITA';
        if ($this->newsletter_email != Config::getNewsletterMailAddress()){
            $model = Teacher::model()->with('user')->findByAttributes(array('corporate_mail'=>$this->newsletter_email));
            $fromName = "{$model->user->firstName} {$model->user->middleName} {$model->user->secondName}";
        }
        $headers = "From: {$fromName} <{$this->newsletter_email}>\n"
            . "MIME-Version: 1.0\n"
            . "Content-Type: text/html;charset=\"utf-8\"" . "\n";
        mail($recipients, mb_encode_mimeheader($this->subject,"UTF-8"),$this->text,$headers);

    }

//    public function loadModel($params){
//        foreach ($params as $key=>$value){
//            if ($this->hasAttribute($key)){
//                $this->$key = $value;
//            }
//
//        }
//        return $this;
//    }

    public function run()
    {
        $this->startSend();
        return true;

    }
}
