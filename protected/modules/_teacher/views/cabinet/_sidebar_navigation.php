<?php
/**
 * @var $model StudentReg
 * @var $countNewMessages int
 */
?>

<div class="navbar-default sidebar" role="navigation">
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
            <li id="nav">
                <a href="#/index"
                   >
                    <i class="fa fa-dashboard fa-fw"></i> Дошка</a>
            </li>
            <li>
                <a href="#/messages">
                    <i class="fa fa-envelope fa-fw"></i> Повідомлення
                    <span ng-cloak class="label label-success" ng-if="messages.countOfNewMessages > 0">{{messages.countOfNewMessages}}</span>
                </a>
            </li>
            <?php if ($model->isTeacher()) { ?>
            <li>
                <a href="javascript:void(0)" onclick="window.open('/cabinet/mail'); return false">
                    <i class="fa fa-at fa-fw"></i> Електронна скринька
                    <span ng-cloak class="label label-success" ng-if="messages.imapMessages > 0">{{messages.imapMessages}}</span>
                </a>

            </li>
            <?php } ?>

            <?php if ($model->isTeacher() || $model->isAdmin()
                    || $model->isAccountant()
                    || $model->isTrainer()
                    || $model->isAuthor()
                    || $model->isContentManager()
                    || $model->isTeacherConsultant()
                    || $model->isSuperVisor()) {?>
            <li>
                    <a href="javascript:void(0)">
                    <i class="fa fa-rss fa-fw"></i>Керування розсилками<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#/newsletter/create">
                            Розіслати повідомлення</a>
                    </li>
                    <li><a href="#/newsletter/templates">
                            Шаблони повідомлень</a>
                    </li>
                    <li><a href="#/scheduler/tasks">
                            Переглянути заплановані завдання</a>
                    </li>
                </ul>
            </li>
            <?php }?>
            <?php if ($model->isTeacher()) { ?>
                <li>
                    <a href="#/teacherprofile">
                        <i class="fa fa-user fa-fw"></i>Профіль співробітника
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
        </ul>
    </div>
</div>














