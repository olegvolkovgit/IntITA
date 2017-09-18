<?php
/**
 * @var $model RegisteredUser
 * @var $countNewMessages int
 */
?>

<div id="m_menu" class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search" style="display: none">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Пошук...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            <?php if ($org=$model->getCurrentOrganization()) { ?>
                <li>
                    <a style="color:green" class="show_elem">
                        <i class="fa fa-trophy fa-fw"></i> Організація: <?php echo $org->name?>
                    </a>
                    <?php if (count($model->getOrganizations())>1) { ?>
                        <a class="show_elem" style="font-size:smaller;padding-top:0;padding-bottom:0"
                           href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/changeOrganization'); ?>" >
                             Змінити організацію
                        </a>
                    <?php } ?>
                    <a href="" uib-tooltip="<?php echo $org->name?>" tooltip-placement="right" class="hid" style="display: none">
                        <i class="fa fa-trophy fa-fw"></i>
                    </a>
                </li>
            <?php } ?>
            <li id="close_open">
                <a href="#" class="show_elem">
                    <i class="fa fa-angle-double-left fa-fw"></i> Згорнути
                </a>
                <a href="" uib-tooltip="Розгорнути" tooltip-placement="right" class="hid" style="display: none">
                    <i class="fa fa-angle-double-right fa-fw"></i>
                </a>
            </li>
            <li id="nav">
                <a href="#/index" class="show_elem">
                    <i class="fa fa-home fa-fw"></i> Дошка
                </a>
                <a href="#/index" uib-tooltip="Дошка" tooltip-placement="right" class="hid" style="display: none">
                    <i class="fa fa-home fa-fw"></i>
                </a>
            </li>
            <li>
                <a href="#/messages" class="show_elem">
                    <i class="fa fa-envelope-o fa-fw"></i> Повідомлення
                    <span ng-cloak class="label label-success" ng-if="messages.countOfNewMessages > 0">{{messages.countOfNewMessages}}</span>
                </a>
                <a href="#/messages" uib-tooltip="Повідомлення" tooltip-placement="right" class="hid" style="display: none">
                    <i class="fa fa-envelope-o fa-fw"></i>
                    <span ng-cloak class="label label-success" ng-if="messages.countOfNewMessages > 0">{{messages.countOfNewMessages}}</span>
                </a>
            </li>
            <?php if ($model->isTeacher()) { ?>
            <li>
                <a href="javascript:void(0)" onclick="window.open('/cabinet/mail'); return false" class="show_elem">
                    <i class="fa fa-at fa-fw"></i> Електронна скринька
                    <span ng-cloak class="label label-success" ng-if="messages.imapMessages > 0">{{messages.imapMessages}}</span>
                </a>
                <a href="javascript:void(0)" uib-tooltip="Електронна скринька" tooltip-placement="right" onclick="window.open('/cabinet/mail'); return false" class="hid" style="display: none">
                    <i class="fa fa-at fa-fw"></i>
                    <span ng-cloak class="label label-success" ng-if="messages.imapMessages > 0">{{messages.imapMessages}}</span>
                </a>
            </li>
            <?php } ?>

            <?php if (Yii::app()->user->model->isDirector()
                || Yii::app()->user->model->isSuperAdmin()
                || Yii::app()->user->model->isAuditor()
                || Yii::app()->user->model->isAdmin()
                || Yii::app()->user->model->isAccountant()
                || Yii::app()->user->model->isTrainer()
                || Yii::app()->user->model->isAuthor()
                || Yii::app()->user->model->isContentManager()
                || Yii::app()->user->model->isTeacherConsultant()
                || Yii::app()->user->model->isSuperVisor()) {?>
            <li>
                    <a href="javascript:void(0)" class="show_elem">
                        <i class="fa fa-mail-reply-all fa-fw"></i> Керування розсилками <span class="fa  fa-ellipsis-v" style="margin-left: 15px;"></span>
                    </a>
                    <a href="javascript:void(0)" uib-tooltip="Керування розсилками" tooltip-placement="right" class="hid" style="display: none">
                        <i class="fa fa-mail-reply-all fa-fw"></i><span class="fa  fa-ellipsis-v" style="margin-left: 15px;"></span>
                    </a>
                <ul class="nav nav-second-level">
                    <li><a href="#/newsletter/create">
                            <em>Розіслати повідомлення</em></a>
                    </li>
                    <li><a href="#/newsletter/templates">
                            <em>Шаблони повідомлень</em></a>
                    </li>
                    <li><a href="#/scheduler/tasks">
                            <em>Переглянути заплановані завдання</em></a>
                    </li>
                </ul>
            </li>
            <?php }?>
            <?php if ($model->isTeacher()) { ?>
                <li>
                    <a href="#/teacherprofile" class="show_elem">
                        <i class="fa fa-user fa-fw"></i> Профіль співробітника
                    </a>
                    <a href="#/teacherprofile" uib-tooltip="Профіль співробітника" tooltip-placement="right" class="hid" style="display: none">
                        <i class="fa fa-user fa-fw"></i>
                    </a>
                </li>
                <li>
                    <a href="#/teacherslinks" class="show_elem">
                        <i class="fa fa-link fa-fw"></i> Корисні посилання
                    </a>
                    <a href="#/teacherslinks" uib-tooltip="Корисні посилання" tooltip-placement="right" class="hid" style="display: none">
                        <i class="fa fa-link fa-fw"></i>
                    </a>
                </li>
            <?php }?>
            <?php
            $roles = Yii::app()->user->model->getRoles();
            foreach($roles as $role) {
                $view = '/_' . $role . '/sidebar';
                $this->renderPartial($view, array(
                    'model' => $model
                ));
            }
            ?>
            <?php if ($model->isTeacher() || Yii::app()->user->model->isDirector()
            || Yii::app()->user->model->isSuperAdmin()
            || Yii::app()->user->model->isAuditor()
            || Yii::app()->user->model->isAdmin()) { ?>
                <li>
                    <a href="#/tasks/executant">
                        <i class="fa fa-calendar-o fa-fw"></i>Мої завдання
                    </a>
                </li>
                <li>
                    <a href="#/tasksManager">
                        <i class="fa fa-bell fa-fw"></i>Менеджер завдань
                        <span ng-cloak class="label label-success" ng-if="taskManagerCount > 0">{{taskManagerCount}}</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>














