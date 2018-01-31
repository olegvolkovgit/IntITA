<?php
$header = new Header();
$lastLink=Yii::app()->user->isGuest?null:Yii::app()->user->model->lastLink();
?>
<!-- Hamburger menu -->
<div id="hambNav">
    <div id="hambButton">
        <img id="hamburger" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hamburger.png'); ?>">
        <img id="hamburgerMini" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hamburger800.png'); ?>">
    </div>
    <div id="hambMenu">
        <a href="<?php echo Yii::app()->homeUrl; ?>" class="logo">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hamburgerlogo.png') ?>"/>
        </a>

        <div class="humblang">
            <?php
            if(Yii::app()->session['lg']==NULL) Yii::app()->session['lg']='ua';
            foreach (array("ua", "en", "ru") as $val) {
                ?>
                <a href="<?php echo Yii::app()->createUrl('site/changeLang', array('lg'=>$val)); ?>" <?php echo (Yii::app()->session['lg'] == $val) ? 'class="selectedLang"' : ''; ?>><?php echo $val; ?></a>
            <?php
            }
            ?>
        </div>
        <ul class="menulist">
            <li><a href="<?php echo Config::getBaseUrl().'/courses'; ?>"><?php echo Yii::t('header', '0016'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl().'/teachers'; ?>"><?php echo Yii::t('header', '0021'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl().'/graduate'; ?>"><?php echo Yii::t('header', '0137'); ?></a></li>
<!--            <li><a href="--><?php //echo Config::getBaseUrl().'/crmForum'; ?><!--" target="_blank">--><?php //echo Yii::t('header', '0017'); ?><!--</a></li>-->
            <li><a href="<?php echo Config::getBaseUrl().'/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a></li>
            <li><a href="http://www.robotamolodi.org/" target="_blank"><?php echo Yii::t('header', '0902'); ?></a></li>
            <?php if (!Yii::app()->user->isGuest) { ?>
                <li><a href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index'); ?>"><?php echo Yii::t('profile', '0815'); ?></a></li>
            <?php } ?>
            <li><a href="http://profitday.info/upcomingevents" target="_blank"><?php echo Yii::t('header', '0912'); ?></a></li>
               <li><a href="<?php echo Mainpage::getPartnerLink() ?>" target="_blank"><?php echo Yii::t('header', '0981'); ?></a></li>
            <li><a href="https://hack.intita.com" target="_blank"><?php echo Yii::t('header', 'Школа хакерів'); ?></a></li>


            <?php if ($lastLink) { ?>
            <li><a href="<?php echo $lastLink ?>"><?php echo Yii::t('header', '0917'); ?></a></li>
            <?php } ?>
<!--            --><?php //if(!Yii::app()->user->isGuest): ?>
<!--                <li>Онлайн чат <i class="logo material-icons chat_icon">chat</i></li>-->
<!--            --><?php //endif; ?>
        </ul>
        <div class="humundline"></div>
        <?php if (Yii::app()->user->isGuest) {
            echo CHtml::link($header->getEnterButton(), '', array('id' => 'hum_button', 'onclick' => 'openSignIn();',));
        } else {
            ?>
            <a id="hum_button" href="<?php echo Config::getBaseUrl(); ?>/site/logout">
                <?php echo $header->getLogoutButton(); ?>
            </a>
            <?php
            $humuser = Yii::app()->user->model;
            $statusInfo = $this->beginWidget('UserStatusWidget',['bigView'=>false, 'registeredUser'=>$humuser]);
            $this->endWidget();
            } 
            ?>
    </div>
</div>