<?php

class Dialog
{
    public $partner1;
    public $partner2;
    private $messages;
    public $header;

    public function __construct(StudentReg $partner1, StudentReg $partner2){
        $this->partner1 = $partner1;
        $this->partner2 = $partner2;
        $this->initMessages();
    }

    public function initMessages()
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'm';
        $criteria->join.= ' LEFT JOIN message_receiver as r ON m.id = r.id_message';
        $criteria->order = 'm.create_date DESC';
        $criteria->addCondition ('m.sender = '.$this->partner1->id.' and r.id_receiver='.$this->partner2->id, 'OR');
        $criteria->addCondition ('m.sender = '.$this->partner2->id.' and r.id_receiver='.$this->partner1->id, 'OR');

        $messages = Messages::model()->findAll($criteria);
        $result = [];
        foreach($messages as $record){
            $record = MessagesFactory::getInstance($record);
            if($record) {
                array_push($result, $record);
            }
        }
        $this->messages = $result;
        if(!empty($this->messages)) {
            $this->header = $this->messages[count($this->messages) - 1]->subject();
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
        foreach($this->messages() as $message){
            if(!$message->isRead($this->partner2)) {
               // var_dump($message);die;
                $flag = $message->read($this->partner2);
            }
        }
        return $flag;
    }

    public function isRead(){
        return true;
    }
}