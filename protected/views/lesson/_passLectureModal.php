<!-- regform -->
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'modalTask.css'); ?>"/>
<!-- regform end-->
<div class="mooda">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
        'action' => Yii::app()->createUrl("/lesson/nextLecture", array('lectureId' => $lecture->id, 'idCourse' => $idCourse)),
    ));
    ?>
    <div class="signIn2">
        <div id="heedd">
            <table>
                <tr>
                    <td>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'LessFinish.jpg'); ?>">
                    </td>
                    <td>
                        <h1 style="">Вітаємо!</h1>
                    </td>
                </tr>
            </table>

            <div class="happily">
                <p>Ти успішно пройшов(ла) заняття!</p>

                <p id="haa">Також можеш</p>

                <p>поділитися успіхом у соціальних мережах:</p>
            </div>
            <!--        <div style="width: 300px; margin: 10px 0 0 10px;" class="image">-->
            <!--            <div class="lectureShare42init"-->
            <!--                --><?php //if($idCourse != 0) { ?>
            <!--                 data-url="-->
            <?php //echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'],'idCourse' => $idCourse)); ?><!--"-->
            <!--                --><?php //}else{ ?>
            <!--                 data-url="-->
            <?php //echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?><!--"-->
            <!--                --><?php //}?>
            <!--                 data-title="-->
            <?php //echo ModuleHelper::getModuleName($lecture->idModule).'. '.Yii::t('sharing','0643') ?><!--"-->
            <!--                 data-image="-->
            <?php //echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?><!--"-->
            <!--                 data-description="Я успішно завершив заняття! INTITA - програмуй майбутнє."-->
            <!--                 data-path="--><?php //echo Config::getBaseUrl(); ?><!--/scripts/lectureShare42/">-->
            <!--            </div>-->
            <!--            <script type="text/javascript" src="-->
            <?php //echo StaticFilesHelper::fullPathTo('js', 'lectureShare42/share42.js'); ?><!--"></script>-->
            <!--        </div>-->
<!--            --><?php //var_dump($lecture->id);die; ?>
            <div class='finishedShare'>
                <a onclick="Share.facebook('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo ModuleHelper::getModuleName($lecture->idModule) ?>. INTITA - програмуй майбутнє.','<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>','Я успішно завершив(ла) заняття <?php echo addslashes(LectureHelper::getLectureTitle($lecture->id)) ?>')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'facebook.png'); ?>"></a>
                <a onclick="Share.googleplus('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo ModuleHelper::getModuleName($lecture->idModule) ?>. INTITA - програмуй майбутнє.','<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>','Я успішно завершив(ла) заняття <?php echo addslashes(LectureHelper::getLectureTitle($lecture->id)) ?>')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'googleplus.png'); ?>"></a>
                <a onclick="Share.linkedin('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo ModuleHelper::getModuleName($lecture->idModule) ?>. INTITA - програмуй майбутнє.','<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>','Я успішно завершив(ла) заняття <?php echo addslashes(LectureHelper::getLectureTitle($lecture->id)) ?>')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'linkedin.png'); ?>"></a>
                <a onclick="Share.vkontakte('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo ModuleHelper::getModuleName($lecture->idModule) ?>. INTITA - програмуй майбутнє.','<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>','Я успішно завершив(ла) заняття <?php echo addslashes(LectureHelper::getLectureTitle($lecture->id)) ?>')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'vkontakte.png'); ?>"></a>
                <a onclick="Share.twitter('<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>','<?php echo ModuleHelper::getModuleName($lecture->idModule) ?>. Я успішно завершив(ла) заняття <?php echo addslashes(LectureHelper::getLectureTitle($lecture->id)) ?> INTITA - програмуй майбутнє!')">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'twitter.png'); ?>"></a>
            </div>
            <input id="signInButtonM2" type="submit" value="ЗАКРИТИ">
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <!-- form -->
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
            url = 'http://vkontakte.ru/share.php?';
            url += 'url=' + encodeURIComponent(purl);
            url += '&title=' + encodeURIComponent(ptitle);
            url += '&description=' + encodeURIComponent(text);
            url += '&image=' + encodeURIComponent(pimg);
            url += '&noparse=true';
            Share.popup(url);
        },
        twitter: function (purl, ptitle) {
            url = 'http://twitter.com/share?';
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