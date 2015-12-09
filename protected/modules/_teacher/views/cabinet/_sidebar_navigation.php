<?php
/* @var $model Teacher */
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
                <a href="#" onclick="loadPage('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                    array('page' => "dashboard", 'teacher' => $model->teacher_id)); ?>')">
                    <i class="fa fa-dashboard fa-fw"></i> Дошка</a>
            </li>

            <?php
            $roles = $model->roles();
            foreach ($roles as $role) {
                ?>
                <li>
                    <a href="#" onclick="loadPage('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                        array('page' => $role->title_en, 'teacher' => $model->teacher_id));?>')">
                        <i class="fa fa-table fa-fw"></i> <?php echo $role->title_ua?>
                        <?php
                        $list = $role->adminPanelList($model);
                        if (count($list) > 0){?>
                        <span class="fa arrow">
                        <?php }?>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php
                        foreach ($list as $attr) {
                        ?>
                        <li>
                            <a href="#" onclick="getTeacherUserInfo('<?php echo Yii::app()->createUrl('/_teacher/cabinet/getUserInfo',
                                array('user' => $attr["student"], 'role' => $role->title_en));?>')">
                                <?=StudentReg::getUserName($attr["student"]);?>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->