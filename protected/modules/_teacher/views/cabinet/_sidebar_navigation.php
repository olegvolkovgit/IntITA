<?php
/**
 * @var $model RegisteredUser
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
            <?php if ($org=$model->getCurrentOrganization()) { ?>
                <li>
                    <a style="color:green">
                        Організація: <?php echo $org->name?>
                    </a>
                    <?php if (count($model->getOrganizations())>1) { ?>
                        <a style="font-size:smaller;padding-top:0;padding-bottom:0" 
                           href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/changeOrganization'); ?>" >
                            <i class="fa fa-exchange fa-fw"></i>Змінити організацію
                        </a>
                    <?php } ?>
                </li>
            <?php } ?>
            <li id="nav">
                <a href="#/index">
                    <i class="fa fa-dashboard fa-fw"></i>Дошка
                </a>
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
                <li>
                    <a href="#/teacherslinks">
                        <i class="fa fa-link fa-fw"></i>Корисні посилання
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

            <li class="header"><span><h3>CRM</h3></span></li>
            <li>
                <a href="#/tasks/executant">
                    Завдання
                </a>
            </li>
        </ul>
    </div>
</div>














