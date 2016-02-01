<?php

class Dialog
{
    public $partner1;
    public $partner2;
    public $messages;
    public $header;

    public function __construct(StudentReg $partner1, StudentReg $partner2){
        $this->partner1 = $partner1;
        $this->partner2 = $partner2;
        $this->initMessages();
    }

    public function initMessages()
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'um';
        $criteria->join = 'LEFT JOIN messages as m ON um.id_message = m.id';
        $criteria->join.= ' LEFT JOIN message_receiver as r ON um.id_message = r.id_message';
        $criteria->order = 'm.create_date DESC';
        //$criteria->addCondition ('r.deleted IS NOT NULL', 'AND');
        $criteria->addCondition ('m.sender = '.$this->partner1->id.' and r.id_receiver='.$this->partner2->id, 'OR');
        $criteria->addCondition ('m.sender = '.$this->partner2->id.' and r.id_receiver='.$this->partner1->id, 'OR');

        $this->messages = UserMessages::model()->findAll($criteria);
        if(!empty($this->messages)) {
            $this->header = $this->messages[count($this->messages) - 1]->subject;
        } else {
            $this->header = "";
        }
    }

    public function messages(){
        return $this->messages;
    }


    //need fix!
    public function deleteDialog()
    {
        foreach($this->messages as $message){
            $message->deleteMessage($this->partner2);
        }
    }

    //need fix!
    public function read(){
        $flag = true;
        foreach($this->messages as $message){
            if(!$message->isRead($this->partner2)) {
                $flag = $message->read($this->partner2);
            }
        }
        return $flag;
    }

    public function isRead(){
        return true;
    }
}