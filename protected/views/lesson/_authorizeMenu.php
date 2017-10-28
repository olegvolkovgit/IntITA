<div id="hambNav">
    <div id="hambButton">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hamburger.png'); ?>">
    </div>
    <div id="hambMenu">
        <?php
        $header = new Header();
        ?>
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
        </ul>
    </div>
</div>
