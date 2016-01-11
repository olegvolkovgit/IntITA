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
                        <i class="fa fa-table fa-fw"></i> Бухгалтер <span class="fa arrow"></span></a>
                </li>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountancy/agreements/index',
                            array('user' => $model->id)); ?>', 'Список договорів')">Договори</a>
                    </li>
                    <li>
                        <a href="#">Рахунки</a>
                    </li>
                    <li>
                        <a href="#">Проплати</a>
                    </li>
                    <li>
                        <a href="#">Налаштування <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Типи проплат</a>
                            </li>
                            <li>
                                <a href="#">Зовнішні джерела коштів</a>
                            </li>
                            <li>
                                <a href="#">Причини відміни проплат</a>
                            </li>
                        </ul>
                    </li>
                </ul>
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














