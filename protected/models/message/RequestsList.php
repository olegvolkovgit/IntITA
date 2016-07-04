<?php

class RequestsList
{
    public static function listAllActiveRequests()
    {
        $authorRequests = MessagesAuthorRequest::model()->findAll('date_approved IS NULL and cancelled = '.MessagesAuthorRequest::ACTIVE);
        $consultantRequests = MessagesTeacherConsultantRequest::model()->findAll('date_approved IS NULL and cancelled = '.MessagesTeacherConsultantRequest::ACTIVE);
        $coworkerRequests = MessagesCoworkerRequest::model()->findAll('date_approved IS NULL and cancelled = '.MessagesCoworkerRequest::ACTIVE);
        $revisionRequests = MessagesRevisionRequest::model()->findAll('date_approved IS NULL and date_rejected IS NULL  and cancelled = '.MessagesRevisionRequest::ACTIVE);
        $moduleRevisionRequests = MessagesModuleRevisionRequest::model()->findAll('date_approved IS NULL and date_rejected IS NULL  and cancelled = '.MessagesModuleRevisionRequest::ACTIVE);
        $requests = array_merge($authorRequests, $consultantRequests, $coworkerRequests, $revisionRequests, $moduleRevisionRequests);
        $return = array('data' => array());
        foreach ($requests as $record) {
            $row = array();
            $row["user"]["title"] = $record->sender()->userNameWithEmail();
            if($record->module()){
                $row["module"]["title"] = $record->module()->getTitle();
            } else {
                $row["module"]["title"] = "не вказано";
            }
            $row["module"]["link"] = $row["user"]["link"] = "'" . Yii::app()->createUrl("/_teacher/_admin/request/request", array(
                    "message" => $record->getMessageId())) . "'";
            $row["dateCreated"] = date("d.m.Y", strtotime($record->message0->create_date));
            $row["type"] = $record->title();
            array_push($return['data'], $row);
        }
        return json_encode($return);
    }

    public static function listAllApprovedRequests()
    {
        $authorRequests = MessagesAuthorRequest::model()->findAll('date_approved IS NOT NULL and cancelled = '.MessagesAuthorRequest::ACTIVE);
        $consultantRequests = MessagesTeacherConsultantRequest::model()->findAll('date_approved IS NOT NULL and cancelled = '.MessagesTeacherConsultantRequest::ACTIVE);
        $coworkerRequests = MessagesCoworkerRequest::model()->findAll('date_approved IS NOT NULL and cancelled = '.MessagesCoworkerRequest::ACTIVE);
        $revisionRequests = MessagesRevisionRequest::model()->findAll('date_approved IS NOT NULL and cancelled = '.MessagesRevisionRequest::ACTIVE);
        $moduleRevisionRequests = MessagesModuleRevisionRequest::model()->findAll('date_approved IS NOT NULL and cancelled = '.MessagesModuleRevisionRequest::ACTIVE);
        $requests = array_merge($authorRequests, $consultantRequests, $coworkerRequests, $revisionRequests, $moduleRevisionRequests);
        $return = array('data' => array());
        foreach ($requests as $record) {
            $row = array();
            $row["user"]["title"] = $record->sender()->userNameWithEmail();
            if($record->module()){
                $row["module"]["title"] = $record->module()->getTitle();
            } else {
                $row["module"]["title"] = "не вказано";
            }
            $row["module"]["link"] = $row["user"]["link"] = "'" . Yii::app()->createUrl("/_teacher/_admin/request/request", array(
                    "message" => $record->getMessageId())) . "'";
            $row["dateCreated"] = date("d.m.Y", strtotime($record->message0->create_date));
            $row["type"] = $record->title();
            array_push($return['data'], $row);
        }
        return json_encode($return);
    }

    public static function listAllDeletedRequests()
    {
        $authorRequests = MessagesAuthorRequest::model()->findAll('cancelled = '.MessagesAuthorRequest::DELETED);
        $consultantRequests = MessagesTeacherConsultantRequest::model()->findAll('cancelled = '.MessagesTeacherConsultantRequest::DELETED);
        $coworkerRequests = MessagesCoworkerRequest::model()->findAll('cancelled = '.MessagesCoworkerRequest::DELETED);
        $revisionRequests = MessagesRevisionRequest::model()->findAll('cancelled = '.MessagesRevisionRequest::DELETED);
        $moduleRevisionRequests = MessagesModuleRevisionRequest::model()->findAll('cancelled = '.MessagesModuleRevisionRequest::DELETED);
        $requests = array_merge($authorRequests, $consultantRequests, $coworkerRequests, $revisionRequests, $moduleRevisionRequests);
        $return = array('data' => array());
        foreach ($requests as $record) {
            $row = array();
            $row["user"]["title"] = $record->sender()->userNameWithEmail();
            if($record->module()){
                $row["module"]["title"] = $record->module()->getTitle();
            } else {
                $row["module"]["title"] = "не вказано";
            }
            $row["module"]["link"] = $row["user"]["link"] = "'" . Yii::app()->createUrl("/_teacher/_admin/request/request", array(
                    "message" => $record->getMessageId())) . "'";
            $row["dateCreated"] = date("d.m.Y", strtotime($record->message0->create_date));
            $row["type"] = $record->title();
            array_push($return['data'], $row);
        }
        return json_encode($return);
    }

    public static function listAllRejectedRevisionRequests()
    {
        $revisionRequests = MessagesRevisionRequest::model()->findAll('date_rejected IS NOT NULL and cancelled = '.MessagesRevisionRequest::ACTIVE);
        $moduleRevisionRequests = MessagesModuleRevisionRequest::model()->findAll('date_rejected IS NOT NULL and cancelled = '.MessagesModuleRevisionRequest::ACTIVE);
        $requests = array_merge($revisionRequests, $moduleRevisionRequests);
        $return = array('data' => array());
        foreach ($requests as $record) {
            $row = array();
            $row["user"]["title"] = $record->sender()->userNameWithEmail();
            if($record->module()){
                $row["module"]["title"] = $record->module()->getTitle();
            } else {
                $row["module"]["title"] = "не вказано";
            }
            $row["module"]["link"] = $row["user"]["link"] = "'" . Yii::app()->createUrl("/_teacher/_admin/request/request", array(
                    "message" => $record->getMessageId())) . "'";
            $row["dateCreated"] = date("d.m.Y", strtotime($record->message0->create_date));
            $row["type"] = $record->title();
            array_push($return['data'], $row);
        }
        return json_encode($return);
    }
}