<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 17.07.2015
 * Time: 14:44
 */
?>
<?php $header = new Header(); ?>
<!-- Hamburger menu -->
<div id="hambNav">
    <div id="hambButton">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hamburger.png'); ?>">
    </div>
    <div id="hambMenu">
        <a href="<?php echo Yii::app()->homeUrl; ?>" class="logo">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hamburgerlogo.png') ?>"/>
        </a>

        <div class="humblang">
            <?php
            if(Yii::app()->session['lg']==NULL) Yii::app()->session['lg']='ua';
            foreach (["ua", "en", "ru"] as $val) {
                ?>
                <a href="<?php echo Yii::app()->createUrl('site/changeLang', array('lg'=>$val)); ?>" <?php echo (Yii::app()->session['lg'] == $val) ? 'class="selectedLang"' : ''; ?>><?php echo $val; ?></a>
            <?php
            }
            ?>
        </div>
        <ul class="menulist">
            <li><a href="<?php echo $this->link1; ?>"><?php echo Yii::t('header', '0016'); ?></a></li>
            <li><a href="<?php echo $this->link2; ?>"><?php echo Yii::t('header', '0021'); ?></a></li>
            <li><a href="<?php echo $this->link5; ?>"><?php echo Yii::t('header', '0137'); ?></a></li>
            <li><a onclick="goToForum()" href="<?php echo $this->link3; ?>"><?php echo Yii::t('header', '0017'); ?></a></li>
            <li><a href="<?php echo $this->link4; ?>"><?php echo Yii::t('header', '0018'); ?></a></li>
        </ul>
        <div class="humundline"></div>
        <?php if (Yii::app()->user->isGuest) {
            echo CHtml::link($header->getEnterButton(), '#', array('id' => 'hum_button', 'onclick' => '$("#mydialog").dialog("open"); return false;',));
        } else {?>
            <a id="hum_button" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/site/logout">
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