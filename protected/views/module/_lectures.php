<?php
/**
 * @var $module Module
 */
?>

<div class="lessonModule" id="lectures">
    <div ng-if="moduleProgress.user.hasRevisionsAccess" class="revisionIco">
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
    <h2><?php echo Yii::t('module', '0225'); ?></h2>

    <div id="lectures-grid" class="grid-view">
        <table class="items">
            <tbody>
                <tr ng-repeat="lecture in moduleProgress.module.lectures track by $index">
                    <td class="aliasColumn">
                        <img ng-src="{{basePath+'/images/module/'+lecture.ico}}"/>
                        <?php echo Yii::t('module', '0381') ?> {{$index+1}}.
                    </td>
                    <td class="titleColumn">
                        <a ng-if="moduleProgress.moduleAccess===true ||
                        (!moduleProgress.notAccessMessage && lecture.order<=moduleProgress.user.lastAccessLectureOrder) ||
                        (moduleProgress.moduleAccess!==false && lecture.isFree && lecture.order<=moduleProgress.user.lastAccessLectureOrder)"
                           href="" ng-click="lectureLink(lecture.id, moduleProgress.course.course_ID)" >{{lecture.title}}</a>
                        <span ng-if="!(moduleProgress.moduleAccess===true ||
                        (!moduleProgress.notAccessMessage && lecture.order<=moduleProgress.user.lastAccessLectureOrder) ||
                        (moduleProgress.moduleAccess!==false && lecture.isFree && lecture.order<=moduleProgress.user.lastAccessLectureOrder))" class="disablesLink"
                              uib-tooltip-html="'{{(moduleProgress.moduleAccess!==false && lecture.isFree || !moduleProgress.notAccessMessage)?finishedPrevLectureMsg:moduleProgress.notAccessMessage}}'">{{lecture.title}}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div ng-if="!moduleProgress.module.lectures.length"><?php echo Yii::t('module', '0375') ?></div>
    </div>
</div>