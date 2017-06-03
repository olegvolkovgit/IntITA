<?php

class RequestsList
{
    public static function listAllActiveRequests()
    {
        $organization=Yii::app()->user->model->getCurrentOrganization()->id;
        $authorRequests = MessagesAuthorRequest::model()->with('idModule')->findAll(
            'date_approved IS NULL and t.cancelled = '.MessagesAuthorRequest::ACTIVE.' and idModule.id_organization='.$organization);
        $consultantRequests = MessagesTeacherConsultantRequest::model()->with('idModule')->findAll(
            'date_approved IS NULL and t.cancelled = '.MessagesTeacherConsultantRequest::ACTIVE.' and idModule.id_organization='.$organization);
        $requests = array_merge($authorRequests, $consultantRequests);
        if(Yii::app()->user->model->isAdmin()){
            //            todo for organization
//            $coworkerRequests = MessagesCoworkerRequest::model()->findAll('date_approved IS NULL and cancelled = '.MessagesCoworkerRequest::ACTIVE);
//            $requests = array_merge($requests, $coworkerRequests);
        }
        if(Yii::app()->user->model->isContentManager()){
            $revisionRequests = MessagesRevisionRequest::model()->with('idRevision.module')->findAll(
                'date_approved IS NULL and date_rejected IS NULL  and t.cancelled = '.MessagesRevisionRequest::ACTIVE.' and module.id_organization='.$organization);
            $moduleRevisionRequests = MessagesModuleRevisionRequest::model()->with('idRevision.module')->findAll(
                'date_approved IS NULL and date_rejected IS NULL  and t.cancelled = '.MessagesModuleRevisionRequest::ACTIVE.' and module.id_organization='.$organization);
            $requests = array_merge($requests, $revisionRequests, $moduleRevisionRequests);
        }

        $return = array('data' => array());
        foreach ($requests as $record) {
            $row = array();
            $row["user"]["title"] = $record->sender()->userNameWithEmail();
            if($record->module()){
                $row["module"]["title"] = $record->module()->getTitle();
            } else {
                $row["module"]["title"] = "не вказано";
            }
            $row["module"]["link"] = $row["user"]["link"] = "#/requests/message/".$record->getMessageId();
            $row["dateCreated"] = date("d.m.Y", strtotime($record->message0->create_date));
            $row["type"] = $record->title();
            array_push($return['data'], $row);
        }
        return json_encode($return);
    }

    public static function listAllApprovedRequests()
    {
        $organization=Yii::app()->user->model->getCurrentOrganization()->id;
        $authorRequests = MessagesAuthorRequest::model()->with('idModule')->findAll(
            'date_approved IS NOT NULL and t.cancelled = '.MessagesAuthorRequest::ACTIVE.' and idModule.id_organization='.$organization);
        $consultantRequests = MessagesTeacherConsultantRequest::model()->with('idModule')->findAll(
            'date_approved IS NOT NULL and t.cancelled = '.MessagesTeacherConsultantRequest::ACTIVE.' and idModule.id_organization='.$organization);

        $requests = array_merge($authorRequests, $consultantRequests);

        if(Yii::app()->user->model->isAdmin()){
            //            todo for organization
//            $coworkerRequests = MessagesCoworkerRequest::model()->findAll('date_approved IS NOT NULL and cancelled = '.MessagesCoworkerRequest::ACTIVE);
//            $requests = array_merge($requests, $coworkerRequests);
        }
        if(Yii::app()->user->model->isContentManager()){
            $revisionRequests = MessagesRevisionRequest::model()->with('idRevision.module')->findAll(
                'date_approved IS NOT NULL and t.cancelled = '.MessagesRevisionRequest::ACTIVE.' and module.id_organization='.$organization);
            $moduleRevisionRequests = MessagesModuleRevisionRequest::model()->with('idRevision.module')->findAll(
                'date_approved IS NOT NULL and t.cancelled = '.MessagesModuleRevisionRequest::ACTIVE.' and module.id_organization='.$organization);
            $requests = array_merge($requests, $revisionRequests, $moduleRevisionRequests);
        }

        $return = array('data' => array());
        foreach ($requests as $record) {
            $row = array();
            $row["user"]["title"] = $record->sender()->userNameWithEmail();
            if($record->module()){
                $row["module"]["title"] = $record->module()->getTitle();
            } else {
                $row["module"]["title"] = "не вказано";
            }
            $row["module"]["link"] = $row["user"]["link"] = "#/requests/message/".$record->getMessageId();
            $row["dateCreated"] = date("d.m.Y", strtotime($record->message0->create_date));
            $row["type"] = $record->title();
            array_push($return['data'], $row);
        }
        return json_encode($return);
    }

    public static function listAllDeletedRequests()
    {
        $organization=Yii::app()->user->model->getCurrentOrganization()->id;
        $authorRequests = MessagesAuthorRequest::model()->with('idModule')->findAll('t.cancelled = '.MessagesAuthorRequest::DELETED.' and idModule.id_organization='.$organization);
        $consultantRequests = MessagesTeacherConsultantRequest::model()->with('idModule')->findAll('t.cancelled = '.MessagesTeacherConsultantRequest::DELETED.' and idModule.id_organization='.$organization);

        $requests = array_merge($authorRequests, $consultantRequests);

        if(Yii::app()->user->model->isAdmin()){
            //            todo for organization
//            $coworkerRequests = MessagesCoworkerRequest::model()->findAll('cancelled = '.MessagesCoworkerRequest::DELETED);
//            $requests = array_merge($requests, $coworkerRequests);
        }
        if(Yii::app()->user->model->isContentManager()){
            $revisionRequests = MessagesRevisionRequest::model()->with('idRevision.module')->findAll('t.cancelled = '.MessagesRevisionRequest::DELETED.' and module.id_organization='.$organization);
            $moduleRevisionRequests = MessagesModuleRevisionRequest::model()->with('idRevision.module')->findAll('t.cancelled = '.MessagesModuleRevisionRequest::DELETED.' and module.id_organization='.$organization);
            $requests = array_merge($requests, $revisionRequests, $moduleRevisionRequests);
        }

        $return = array('data' => array());
        foreach ($requests as $record) {
            $row = array();
            $row["user"]["title"] = $record->sender()->userNameWithEmail();
            if($record->module()){
                $row["module"]["title"] = $record->module()->getTitle();
            } else {
                $row["module"]["title"] = "не вказано";
            }
            $row["module"]["link"] = $row["user"]["link"] = "#/requests/message/".$record->getMessageId();
            $row["dateCreated"] = date("d.m.Y", strtotime($record->message0->create_date));
            $row["type"] = $record->title();
            array_push($return['data'], $row);
        }
        return json_encode($return);
    }

    public static function listAllRejectedRevisionRequests()
    {
        $organization=Yii::app()->user->model->getCurrentOrganization()->id;
        $return = array('data' => array());
        if(Yii::app()->user->model->isContentManager()){
            $revisionRequests = MessagesRevisionRequest::model()->with('idRevision.module')->findAll('date_rejected IS NOT NULL and t.cancelled = '.MessagesRevisionRequest::ACTIVE.' and module.id_organization='.$organization);
            $moduleRevisionRequests = MessagesModuleRevisionRequest::model()->with('idRevision.module')->findAll('date_rejected IS NOT NULL and t.cancelled = '.MessagesModuleRevisionRequest::ACTIVE.' and module.id_organization='.$organization);
            $requests = array_merge($revisionRequests, $moduleRevisionRequests);
            foreach ($requests as $record) {
                $row = array();
                $row["user"]["title"] = $record->sender()->userNameWithEmail();
                if($record->module()){
                    $row["module"]["title"] = $record->module()->getTitle();
                } else {
                    $row["module"]["title"] = "не вказано";
                }
                $row["module"]["link"] = $row["user"]["link"] = "#/requests/message/".$record->getMessageId();
                $row["dateCreated"] = date("d.m.Y", strtotime($record->message0->create_date));
                $row["type"] = $record->title();
                array_push($return['data'], $row);
            }
        }
        return json_encode($return);
    }
}