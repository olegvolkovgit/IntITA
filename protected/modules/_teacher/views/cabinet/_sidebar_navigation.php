<?php
/* @var $model StudentReg */
?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Пошук...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
            </li>
            <li>
                <a href="#" ng-click='ngLoadDashboard("<?php echo Yii::app()->createUrl("/_teacher/cabinet/loadDashboard",
                    array('user' => $model->id)); ?>")'>
                    <i class="fa fa-dashboard fa-fw"></i> Дошка</a>
            </li>

            <li id="menu-link">
                <a href="/pages/forms.html" onclick="function (){
                    currentUrl = '<?php echo Yii::app()->createUrl('/_teacher/cabinet/adminPage',
                    array('user' => $model->id)); ?>'}">
                    <i class="fa fa-dashboard fa-fw"></i> Forms</a>
            </li>

            <li id="menu-link">
                <a href="#admin"
                onclick="setCurrentUrl('<?php echo Yii::app()->createUrl('/_teacher/cabinet/adminPage',array('user' => $model->id)); ?>')">
                    <i class="fa fa-dashboard fa-fw"></i> Buttons</a>
            </li>

            <li id="menu-link">
                <a href="#accountant"
                   onclick="setCurrentUrl('<?php echo Yii::app()->createUrl('/_teacher/cabinet/accountantPage',array('user' => $model->id)); ?>')">
                    <i class="fa fa-dashboard fa-fw"></i> Icons</a>
            </li>

            <li id="menu-link">
                <a href="/pages/notifications.html">
                    <i class="fa fa-dashboard fa-fw"></i> Notifications</a>
            </li>

            <?php
            if ($model->isAdmin()) {
                ?>
                <li>

                    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/adminPage',
                        array('user' => $model->id)); ?>', 'Панель адміністрування')">
                        <i class="fa fa-table fa-fw"></i> Адміністратор</a>
                </li>
            <?php
            }

            if ($model->isAccountant()) {
                ?>
                <li>
                    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/accountantPage',
                        array('user' => $model->id)); ?>', 'Бухгалтерія')">
                        <i class="fa fa-table fa-fw"></i> Бухгалтер</a>
                </li>
            <?php
            }

            if ($model->isTeacher()) {
               $this->renderPartial('_teacherRoles', array('teacher' => $model->getTeacherModel()));
            }
            ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->














