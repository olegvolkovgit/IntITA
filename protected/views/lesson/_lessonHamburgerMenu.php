<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 19.10.2015
 * Time: 11:01
 */
?>
<!-- Hamburger menu -->
<div id="hambNav">
    <div id="hambButton">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hamburger.png'); ?>">
    </div>
    <div id="hambMenu">
        <?php
        if ($idCourse != 0) {
            $this->renderPartial('/site/_shareMetaTag', array(
                'url' => Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $idModule, 'idCourse' => $idCourse)),
                'title' => ModuleHelper::getModuleName($idModule) . '. ' . Yii::t('sharing', '0643'),
                'description' => Yii::t('sharing', '0644'),
            ));
        } else {
            $this->renderPartial('/site/_shareMetaTag', array(
                'url' => Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $idModule)),
                'title' => ModuleHelper::getModuleName($idModule) . '. ' . Yii::t('sharing', '0643'),
                'description' => Yii::t('sharing', '0644'),
            ));
        }
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
            <li><a href="<?php echo Config::getBaseUrl().'/forum'; ?>" target="_blank"><?php echo Yii::t('header', '0017'); ?></a></li>
            <li><a href="<?php echo Config::getBaseUrl().'/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a></li>
        </ul>
        <div class="humundline"></div>
        <?php if (Yii::app()->user->isGuest) {
            echo CHtml::link($header->getEnterButton(), '#', array('id' => 'hum_button', 'onclick' => '$("#mydialog").dialog("open"); return false;',));
        } else {?>
            <a id="hum_button" href="<?php echo Config::getBaseUrl(); ?>/site/logout">
                <?php echo $header->getLogoutButton(); ?>
            </a>
            <?php
            $humuser = StudentReg::model()->findByPk(Yii::app()->user->id);
            ?>
            <div class="humStatus">
                <a href="<?php echo Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)); ?>">
                    <div class="humavatar"><img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $humuser->avatar); ?>"/></div><div class="humName">
                        <?php echo $humuser->nickname; ?></br>
                        <?php echo $humuser->firstName; ?></br>
                        <?php echo $humuser->secondName; ?></br>
                        <span style="color: #33cc00; font-size: smaller">&#x25A0; online</span>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
