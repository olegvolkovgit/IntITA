<div class="nextLecture" ng-controller="starsBlockCtrl">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
//        'action' => Yii::app()->createUrl("/lesson/nextLecture", array('lectureId' => $lecture->id, 'idCourse' => $idCourse)),
//        'htmlOptions' => array('ng-submit'=>"sendData(ratings)"),
        'htmlOptions' => array('ng-submit'=>"sendData(res, $lecture->id , $idCourse)")
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
                <p>
<!--                    todo-->
<!--                    --><?php //echo Yii::t('lecture', '0676'); ?>
                    Ти успішно склав(ла) підсумкове завдання, для завершення оціни, будь ласка, заняття
                </p>

                <!-- *** Show stars (3 rows) for rating lectures ***  -->
                <div>
                    <div ng-repeat="rating in ratings track by $index">
                        <p>{{rating.description}}</p>
                        <span uib-rating ng-model="rating.rate" max="max" read-only="isReadonly"
                              on-hover="hoveringOver(value, $index)" on-leave="rating.overStar = null"
                              titles="['one','two','three']" aria-labelledby="default-rating">
                        </span>
                        <span class="label" ng-class="{ 'label-warning': rating.number<4,
                                                        'label-info': rating.number>=4 && rating.number<8,
                                                        'label-success': rating.number>=8 }"
                                            ng-show="rating.overStar && !isReadonly">
                            {{rating.number}}
                        </span>
                    </div>

                    <div ng-if="ratings[0].rate>=1 && ratings[0].rate<=4 ||
                                ratings[1].rate>=1 && ratings[1].rate<=4 ||
                                ratings[2].rate>=1 && ratings[2].rate<=4">
                        <p>Будь-ласка допоможи нам зробити заняття кращими! Поясни, чому саме ти поставив(ла) таку оцінку:</p>
                        <p ng-if="ratings[0].rate>=1 && ratings[0].rate<=4">{{ ratings[0].description }} - {{ ratings[0].rate }}</p>
                        <p ng-if="ratings[1].rate>=1 && ratings[1].rate<=4">{{ ratings[1].description }} - {{ ratings[1].rate }}</p>
                        <p ng-if="ratings[2].rate>=1 && ratings[2].rate<=4">{{ ratings[2].description }} - {{ ratings[2].rate }}</p>

                        <textarea rows="4" style="width: 90%; resize: none; border-radius: 4px;" ng-model="res.comment">
                        </textarea>
                    </div>

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
            <input class="modalButton" type="submit" value="<?php echo Yii::t('lecture', '0674'); ?>">
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