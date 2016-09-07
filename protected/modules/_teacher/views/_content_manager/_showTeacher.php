<?php
/**
 * @var $user RegisteredUser
 */
$teacher = $user->getTeacher();
?>
<div class="panel panel-default" ng-controller="usersCtrl">
    <div class="panel-body">
        <uib-tabset >
            <uib-tab index="0" heading="Головне">
                <?php $this->renderPartial('/_content_manager/_mainTeacherTab', array('user' =>$user));?>
            </uib-tab>
            <?php if ($user->isAuthor()) { ?>
                <uib-tab index="1" heading="Автор">
                    <?php $this->renderPartial('/_content_manager/_authorTab', array('user' =>$user));?>
                </uib-tab>
            <?php } ?>
            <?php if ($user->isConsultant()) { ?>
                <uib-tab index="2" heading="Консультант">
                    <?php $this->renderPartial('/_content_manager/_consultantTab', array('user' =>$user));?>
                </uib-tab>
            <?php } ?>
            <?php if ($user->isTeacherConsultant()) { ?>
                <uib-tab index="3" heading="Викладач">
                    <?php $this->renderPartial('/_content_manager/_teacherConsultantTab', array('user' =>$user));?>
                </uib-tab>
            <?php } ?>
        </uib-tabset>
    </div>
</div>
