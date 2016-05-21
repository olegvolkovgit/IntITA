<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 20.05.16
 * Time: 22:45
 */
class RevisionQuiz extends CActiveRecord{

    public function events()
    {
        return array_merge(parent::events(), array(
            'onAfterApprove'=>'afterApprove'
        ));
    }

    public function behaviors(){
        return array(
            'uidUpdateBehavior' => array(
                'class' => 'RevisionQuizUidUpdateBehavior'
            ),
        );
    }

    public function onAfterApprove($event) {
        $this->raiseEvent('onAfterApprove', $event);
    }

}