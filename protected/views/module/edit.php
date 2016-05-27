<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 29.02.2016
 * Time: 13:38
 */

?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'moduleEdit.css'); ?>" />
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers/moduleEditCtrl.js'); ?>"></script>
<script type="text/javascript">
    idModule = <?php echo $module->module_ID;?>;
    basePath = '<?php echo Config::getBaseUrl();?>';
    lang = '<?php echo CommonHelper::getLanguage();?>';
</script>
<div id="lessonHumMenu">
    <?php $this->renderPartial('/module/_hamburgerMenu'); ?>
</div>
<div class="lessonModule" id="lectures" ng-controller="moduleEditCtrl">
    <div class="moduleTitle">
        <h1>
            <?php echo $module->getTitle(); ?>
        </h1>
    </div>
    <div ng-click="showForm();">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'ajaxaddlecture-form',
        )); ?>
        <a href="#lessonForm">
            <?php echo CHtml::hiddenField('idmodule', $module->module_ID); ?>
            <?php
            echo CHtml::ajaxSubmitButton('', CController::createUrl('module/lecturesupdate'),
                array('update' => '#lessonForm'), array('id' => 'addLecture','title'=>Yii::t('module', '0374')));
            ?>
        </a>
        <?php $this->endWidget(); ?>
    </div>
    <h2><?php echo Yii::t('module', '0225'); ?></h2>
    <img style="display:inline-block" id="moduleLoading" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'loading.gif'); ?>"/>
    <div ng-cloak id="lecturesList">
        <table class="lecturesTable">
            <tr ng-repeat="lecture in lectures.rawData track by $index" class="lectureRaw">
                <td class="lectureButtons">
                    <img ng-click="upLecture(lecture.id, lecture.idModule)" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png')?>" title="<?php echo Yii::t('module', '0379')?>">
                    <img ng-click="downLecture(lecture.id, lecture.idModule)" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png')?>" title="<?php echo Yii::t('module', '0380')?>">
<!--                    <img ng-click="deleteLecture(lecture.id, lecture.idModule)" src="--><?php //echo StaticFilesHelper::createPath('image', 'editor', 'delete.png')?><!--" title="--><?php //echo Yii::t('module', '0378')?><!--">-->
                </td>
                <td class="lectureOrder">
                    <span><?php echo Yii::t('module', '0381') ?> {{$index+1}}.</span>
                </td>
                <td class="lecturesTitle">
                    <div class="moduleTitle">
                        <a href="{{lectures.lecturesLink[$index]}}">
                            <span class="lectureTitle">{{lecture.title}}</span>
                        </a>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="lessonForm">
        <?php $this->renderPartial('_addLessonForm', array('model'=>$module)); ?>
    </div>
    <div class="backButton">
        <a href="<?php echo isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:Yii::app()->createUrl("module/index", array("idModule" => $module->module_ID)); ?>">
            <?php echo Yii::t('module', '0808') ?>
        </a>
    </div>
</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'titleValidation.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'moduleDialogs.js'); ?>"></script>