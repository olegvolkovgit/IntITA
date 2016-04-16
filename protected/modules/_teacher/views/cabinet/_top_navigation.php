<?php
/* @var $message Messages *
 * @var $record UserMessages *
 * @var $model RegisteredUser
 * @var $requests array
 * @var $newMessages array
 * @var $countNewMessages int
 */
?>
<div class="navbar-header">
    <a href="<?php echo Yii::app()->homeUrl; ?>" class="navbar-brand logo">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hamburgerlogo.png') ?>"/>
    </a>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <a class="navbar-brand logoname" href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index'); ?>">
        Особистий кабінет - Головна</a>
</div>

<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <?php if($countNewMessages > 0){?>
                <span class="label label-success"><?=$countNewMessages;?></span>
            <?php }?>
            <i class="fa fa-envelope fa-fw" onclick="load('<?=Yii::app()->createUrl("/_teacher/messages/index")?>')"></i>
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <?php $this->renderPartial('top_nav_messages',  array('newMessages' => $newMessages, 'model' => $model));?>
        </ul>
    </li>

    <?php if($model->isAdmin() || $model->isContentManager()){?>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <?php if(!empty($requests)){?>
                <span class="label label-success"><?=count($requests)?></span>
            <?php }?>
            <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-tasks">
            <?php $this->renderPartial('top_nav_requests', array('requests' => $requests));?>
        </ul>
    </li>
    <?php }?>

<!--    <li class="dropdown">-->
<!--        <a class="dropdown-toggle" data-toggle="dropdown" href="#">-->
<!--            <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>-->
<!--        </a>-->
<!--        <ul class="dropdown-menu dropdown-alerts">-->
<!--            --><?php //$this->renderPartial('top_nav_alerts');?>
<!--        </ul>-->
<!--    </li>-->

    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="<?php echo
                Yii::app()->createUrl('studentreg/profile', array('idUser' => Yii::app()->user->getId())); ?>">
                    <i class="fa fa-user fa-fw"></i> Мій профіль</a>
            </li>
            <li class="divider"></li>
            <li class="lang">
                <?php
                if (Yii::app()->session['lg'] == NULL) Yii::app()->session['lg'] = 'ua';
                foreach (array("ua", "en", "ru") as $val) {
                    ?>
                    <a href="<?php echo Yii::app()->createUrl('site/changeLang', array('lg' => $val)); ?>"
                        <?php echo (Yii::app()->session['lg'] == $val) ? 'class="selectedLang"' : ''; ?>>
                        <?php echo $val; ?>
                    </a>
                    <?php
                }
                ?>
            </li>
            <li><a href="<?php echo Config::getBaseUrl() . '/courses'; ?>"><i
                        class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0016'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl() . '/teachers'; ?>"><i
                        class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0021'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl() . '/graduate'; ?>"><i
                        class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0137'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl() . '/forum'; ?>" target="_blank"><i
                        class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0017'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl() . '/aboutus'; ?>"><i
                        class="fa fa-user fa-fw"></i><?php echo Yii::t('header', '0018'); ?></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">
                    <i class="fa fa-sign-out fa-fw"></i> Вихід</a>
            </li>
        </ul>
    </li>
</ul>
