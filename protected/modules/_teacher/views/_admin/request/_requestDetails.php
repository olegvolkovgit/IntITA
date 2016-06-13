<?php
/**
 * @var $model IRequest
 */
switch($model->type()){
    case Request::AUTHOR_REQUEST:
        $this->renderPartial('_authorRequest', array('model' => $model));
        break;
    case Request::TEACHER_CONSULTANT_REQUEST:
        $this->renderPartial('_teacherConsultantRequest', array('model' => $model));
        break;
    case Request::COWORKER_REQUEST:
        $this->renderPartial('_coworkerRequest', array('model' => $model));
        break;
    case Request::REVISION_REQUEST:
        $this->renderPartial('_revisionRequest', array('model' => $model));
        break;
    default:
        return null;
}
?>


