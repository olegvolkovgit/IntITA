<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 14.11.2016
 * Time: 21:38
 */
class NewsLetter implements ITask
{
    /**
     * Type of newsletter
     * type strig
     */
    private $type;
    /**
     * Recipients
     * type array
     */
    private $recipients;
    /**
     * Recipients
     * type string
     */
    private $subject;
    /**
     * Recipients
     * type string
     */
    private $message;

    private $email;

    private $emailBaseCategory;

    public function __construct($type, $recipients, $subject, $message, $email, $emailBaseCategory=null)
    {
        $this->type = $type;
        $this->recipients = $recipients;
        $this->subject = $subject;
        $this->message = $message;
        $this->email = $email;
        $this->emailBaseCategory = $emailBaseCategory;
    }

    /**
     *
     * Start sending letters
     */
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
                foreach ($this->recipients as $role) {
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
                break;
            case "allUsers":
                $users = StudentReg::model()->findAll('cancelled=0');
                if (isset($users)) {
                    foreach ($users as $user) {
                        array_push($mailList, $user->email);
                    }
                }
                break;
            case "users":
                $mailList = $this->recipients;
                break;
            case "groups":
                $criteria = new CDbCriteria();
                $criteria->with = array('user','group');
                $criteria->addInCondition('group.id',$this->recipients);
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
                $criteria->addInCondition('subgroupName.id',$this->recipients);
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
                if(intval($this->emailBaseCategory)===0){
                    $criteria->distinct = true;
                    $criteria->select = "email";
                }else{
                    $criteria->addCondition('category='.$this->emailBaseCategory);
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
        if ($this->email != Config::getNewsletterMailAddress()){
            $model = Teacher::model()->with('user')->findByAttributes(array('corporate_mail'=>$this->email));
            $fromName = "{$model->user->firstName} {$model->user->middleName} {$model->user->secondName}";
        }
        $headers = "From: {$fromName} <{$this->email}>\n"
            . "MIME-Version: 1.0\n"
            . "Content-Type: text/html;charset=\"utf-8\"" . "\n";
        mail($recipients, mb_encode_mimeheader($this->subject,"UTF-8"),$this->message,$headers);

    }

    public function run()
    {
        $this->startSend();
        return true;

    }
}