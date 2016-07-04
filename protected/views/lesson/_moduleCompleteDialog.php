<div class="last">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
    ));
    ?>
    <div class="modalBody">
            <table>
                <tr>
                    <td>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'LessFinish.jpg'); ?>">
                    </td>
                    <td>
                        <h1 style=""><?php echo Yii::t('lecture', '0675'); ?></h1>
                    </td>
                </tr>
            </table>

            <div class="modalContent">
                <p><?php echo Yii::t('lecture', '0801'); ?></p>
                <p class="sharingText"><?php echo Yii::t('lecture', '0677'); ?></p>
                <p><?php echo Yii::t('lecture', '0678'); ?></p>
            </div>
            <div class='finishedShare'>
                <a onclick="Share.facebook('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo addslashes($lecture->module->getTitle()) ?>. INTITA - програмуй майбутнє.','<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>','Я успішно завершив(ла) заняття <?php echo addslashes(CHtml::decode(Lecture::getLectureTitle($lecture->id))) ?>')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'facebook.png'); ?>"></a>
                <a onclick="Share.googleplus('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo addslashes($lecture->module->getTitle()) ?>. INTITA - програмуй майбутнє.','<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>','Я успішно завершив(ла) заняття <?php echo addslashes(CHtml::decode(Lecture::getLectureTitle($lecture->id))) ?>')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'googleplus.png'); ?>"></a>
                <a onclick="Share.linkedin('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo addslashes($lecture->module->getTitle()) ?>. INTITA - програмуй майбутнє.','<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>','Я успішно завершив(ла) заняття <?php echo addslashes(CHtml::decode(Lecture::getLectureTitle($lecture->id))) ?>')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'linkedin.png'); ?>"></a>
                <a onclick="Share.vkontakte('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo addslashes($lecture->module->getTitle()) ?>. INTITA - програмуй майбутнє.','<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>','Я успішно завершив(ла) заняття <?php echo addslashes(CHtml::decode(Lecture::getLectureTitle($lecture->id))) ?>')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'vkontakte.png'); ?>"></a>
                <a onclick="Share.twitter('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo addslashes($lecture->module->getTitle()) ?>. Я успішно завершив(ла) заняття <?php echo addslashes(Lecture::getLectureTitle($lecture->id)) ?> INTITA - програмуй майбутнє!')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'twitter.png'); ?>"></a>
            </div>
            <input class="modalButton" type="submit" value="ОК">
    </div>
    <!-- form -->
    <?php $this->endWidget(); ?>
</div>
<script>
    Share = {
        facebook: function (purl, ptitle, pimg, text) {
            url = 'https://www.facebook.com/sharer/sharer.php?m2w&s=100';
            url += '&p[url]=' + encodeURIComponent(purl);
            url += '&p[title]=' + encodeURIComponent(ptitle);
            url += '&p[summary]=' + encodeURIComponent(text);
            url += '&p[images][0]=' + encodeURIComponent(pimg);
            Share.popup(url);
        },
        googleplus: function (purl, ptitle, pimg, text) {
            url = 'https://plus.google.com/share?';
            url += 'url=' + encodeURIComponent(purl);
            url += '&title=' + encodeURIComponent(ptitle);
            url += '&description=' + encodeURIComponent(text);
            url += '&image=' + encodeURIComponent(pimg);
            Share.popup(url);
        },
        linkedin: function (purl, ptitle, pimg, text) {
            url = 'https://www.linkedin.com/shareArticle?mini=true&';
            url += 'url=' + encodeURIComponent(purl);
            url += '&title=' + encodeURIComponent(ptitle);
            url += '&summary=' + encodeURIComponent(text);
            url += '&image=' + encodeURIComponent(pimg);
            Share.popup(url);
        },
        vkontakte: function (purl, ptitle, pimg, text) {
            url = 'https://vkontakte.ru/share.php?';
            url += 'url=' + encodeURIComponent(purl);
            url += '&title=' + encodeURIComponent(ptitle);
            url += '&description=' + encodeURIComponent(text);
            url += '&image=' + encodeURIComponent(pimg);
            url += '&noparse=true';
            Share.popup(url);
        },
        twitter: function (purl, ptitle) {
            url = 'https://twitter.com/share?';
            url += 'text=' + encodeURIComponent(ptitle);
            url += '&url=' + encodeURIComponent(purl);
            url += '&counturl=' + encodeURIComponent(purl);
            Share.popup(url);
        },
        popup: function (url) {
            window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
        }
    };
</script>