<?php
/**
 * @var $user RegisteredUser
 */
$teacher = $user->getTeacher();
?>
<div class="panel panel-default" ng-controller="usersCtrl">
        <div class="panel-body">
            <?php if (Yii::app()->user->model->isAdmin()) { ?>
                <ul class="list-inline">
                    <li>
                        <button type="button" class="btn btn-primary" ng-click="changeView('/admin/users')">Користувачі
                        </button>
                    </li>
                </ul>
            <?php } ?>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="main">
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
    </div>
</div>

