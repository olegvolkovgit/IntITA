
<?php
/* @var $message Messages */
?>
<div class="navbar-header">
    <a href="<?php echo Yii::app()->homeUrl; ?>" class="navbar-brand" >
        <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hamburgerlogo.png') ?>"/>
    </a>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index');?>">
        Особистий кабінет - Головна</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <?php
            foreach($newMessages as $record){
                               ?>
                <li>
                    <a href="#">
                        <div>
                            <strong><?=$record['id_message'];?></strong>
                                    <span class="pull-right text-muted">
                                        <em>Topic</em>
                                    </span>
                        </div>
                        <div>Message subject</div>
                    </a>
                </li>
            <?php
            }
            ?>

                <a class="text-center" href="#">
                    <strong><a href="#" onclick="load('<?=Yii::app()->createUrl("/_teacher/messages/index")?>')">
                            Всі повідомлення</a></strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-messages -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-tasks">
            <li>
                <a href="#">
                    <div>
                        <p>
                            <strong>Task 1</strong>
                            <span class="pull-right text-muted">40% Complete</span>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span class="sr-only">40% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <p>
                            <strong>Task 2</strong>
                            <span class="pull-right text-muted">20% Complete</span>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                <span class="sr-only">20% Complete</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <p>
                            <strong>Task 3</strong>
                            <span class="pull-right text-muted">60% Complete</span>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                <span class="sr-only">60% Complete (warning)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <p>
                            <strong>Task 4</strong>
                            <span class="pull-right text-muted">80% Complete</span>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                <span class="sr-only">80% Complete (danger)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>See All Tasks</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-tasks -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> Мої консультації
                        <span class="pull-right text-muted small">розклад</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                        <span class="pull-right text-muted small">12 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-tasks fa-fw"></i> New Task
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>See All Alerts</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-alerts -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="<?php echo
                Yii::app()->createUrl('studentreg/profile', array('idUser' => Yii::app()->user->getId()));?>">
                    <i class="fa fa-user fa-fw"></i> Мій профіль</a>
            </li>
            <li class="divider"></li>
            <li class="lang">
                <?php
                if(Yii::app()->session['lg']==NULL) Yii::app()->session['lg']='ua';
                foreach (array("ua", "en", "ru") as $val) {
                    ?>
                    <a href="<?php echo Yii::app()->createUrl('site/changeLang', array('lg'=>$val)); ?>"
                        <?php echo (Yii::app()->session['lg'] == $val) ? 'class="selectedLang"' : ''; ?>>
                        <?php echo $val; ?>
                    </a>
                <?php
                }
                ?>
            </li>
            <li><a href="<?php echo Config::getBaseUrl().'/courses'; ?>"><i class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0016'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl().'/teachers'; ?>"><i class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0021'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl().'/graduate'; ?>"><i class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0137'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl().'/forum'; ?>" target="_blank"><i class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0017'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl().'/aboutus'; ?>"><i class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0018'); ?></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo Yii::app()->createUrl('site/logout');?>">
                    <i class="fa fa-sign-out fa-fw"></i> Вихід</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
</ul>
<!-- /.navbar-top-links -->
