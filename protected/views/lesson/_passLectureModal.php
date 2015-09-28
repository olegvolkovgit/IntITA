<!-- regform -->
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'modalTask.css'); ?>"/>
<!-- regform end-->
<div class="mooda">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
        'action' => Yii::app()->createUrl("/lesson/nextLecture", array('lectureId'=>$lecture->id, 'idCourse'=>$idCourse)),
    ));
    ?>
    <div class="signIn2">
        <div id="heedd">
        <table>
            <tr>
                <td>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'LessFinish.jpg'); ?>"></td>
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
        <div style="width: 300px; margin: 10px 0 0 10px;" class="image">
            <div class="lectureShare42init"
                <?php if($idCourse != 0) { ?>
                 data-url="<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'],'idCourse' => $idCourse)); ?>"
                <?php }else{ ?>
                 data-url="<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])); ?>"
                <?php }?>
                 data-title="<?php echo ModuleHelper::getModuleName($lecture->idModule).'. '.Yii::t('sharing','0643') ?>"
                 data-image="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>"
                 data-description="Я успішно завершив заняття! INTITA - програмуй майбутнє."
                 data-path="<?php echo Config::getBaseUrl(); ?>/scripts/lectureShare42/">
            </div>
            <script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'lectureShare42/share42.js'); ?>"></script>
        </div>

        <input id="signInButtonM2" type="submit" value="ЗАКРИТИ">
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
</div>