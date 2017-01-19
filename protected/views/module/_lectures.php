<?php
/**
 * @var $module Module
 * @var $data Lecture
 */
?>

<div class="lessonModule" id="lectures">
    <div ng-if="module.user.isAuthor || module.user.isContentManager" class="revisionIco">
        <label><?php echo Yii::t('revision', '0905') ?>:
        <a href="<?php echo Yii::app()->createUrl('/moduleRevision/moduleRevisions', array('idModule'=>$module->module_ID, 'idCourse'=>$idCourse)); ?>">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'moduleRevisions.png'); ?>"
                 title="<?php echo Yii::t('revision', '0906') ?>"/>
        </a>
        <a href="<?php echo Yii::app()->createUrl('/revision/moduleLecturesRevisions', array('idModule'=>$module->module_ID)); ?>">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'lectureRevisions.png'); ?>"
                 title="<?php echo Yii::t('revision', '0907') ?>"/>
        </a>
        </label>
    </div>
    <a ng-if="module.user.canSendRequest && !user.isAuthor" href=""
       ng-click="sendRequest('<?php echo Yii::app()->createUrl("/module/sendRequest", array("user" => Yii::app()->user->getId(), "moduleId" => $module->module_ID)); ?>')">
        <button id="requestBth" title="<?php echo Yii::t('module', '0911') ?>"><?php echo Yii::t('module', '0910') ?></button>
    </a>
    <h2><?php echo Yii::t('module', '0225'); ?></h2>

    <div id="lectures-grid" class="grid-view">
        <div class="summary"></div>
        <table class="items">
            <tbody>
                <tr ng-repeat="lecture in module.lectures track by $index">
                    <td class="aliasColumn">
                        <img ng-src="{{basePath+'/images/module/'+lecture.ico}}"/>
                        <?php echo Yii::t('module', '0381') ?> {{$index+1}}.
                    </td>
                    <td class="titleColumn">
                        <a ng-if="module.moduleAccess===true ||
                        (!module.notAccessMessage && lecture.order<=module.user.lastAccessLectureOrder) ||
                        (module.moduleAccess!==false && lecture.isFree && lecture.order<=module.user.lastAccessLectureOrder)"
                           href="" ng-click="lectureLink(lecture.id, module.idCourse)" >{{lecture.title}}</a>
                        <span ng-if="!(module.moduleAccess===true ||
                        (!module.notAccessMessage && lecture.order<=module.user.lastAccessLectureOrder) ||
                        (module.moduleAccess!==false && lecture.isFree && lecture.order<=module.user.lastAccessLectureOrder))" class="disablesLink"
                              uib-tooltip-html="'{{(module.moduleAccess!==false && lecture.isFree || !module.notAccessMessage)?finishedPrevLectureMsg:module.notAccessMessage}}'">{{lecture.title}}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div ng-if="!module.lectures.length"><?php echo Yii::t('module', '0375') ?></div>
    </div>
</div>