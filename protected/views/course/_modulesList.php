<script type="text/javascript">
    basePath = '<?php echo Config::getBaseUrl();?>';
</script>
<div class="courseModules">
    <?php
    if ($isEditor) { ?>
        <div class="revisionIco">
            <label><?php echo Yii::t('revision', '0905') ?>:
                <a href="<?php echo Yii::app()->createUrl('/courseRevision/courseRevisions', array('idCourse'=>$model->course_ID)); ?>">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'courseRevisions.png'); ?>"
                         title="<?php echo Yii::t('revision', '0908') ?>"/>
                </a>
                <a href="<?php echo Yii::app()->createUrl('/moduleRevision/courseModulesRevisions', array('idCourse'=>$model->course_ID)); ?>">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'moduleRevisions.png'); ?>"
                         title="<?php echo Yii::t('revision', '0909') ?>"/>
                </a>
            </label>
        </div>
    <?php }?>
    <h2><?php echo Yii::t('course', '0330'); ?></h2>
    <img style="display:inline-block" class="modulesLoading" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'loading.gif'); ?>"/>
    <div ng-cloak id="modulesList">
        <div ng-repeat="module in courseProgress.modules track by $index">
            <div class="modulesTitle"
                 ng-class="{
                 disableModuleStyle: (!module.access || !courseProgress.courseStatus) && !courseProgress.hasAccess,
                 availableModuleStyle: (module.access && courseProgress.courseStatus) || courseProgress.hasAccess,
                 inProgressModuleStyle: module.progress=='inProgress',
                 inlineModuleStyle: module.progress=='queue',
                 inFinishedModuleStyle: module.progress=='finished'}">
                <a href="" ng-click="moduleLink(module.id_module)">
                    <div uib-tooltip-html="'{{module.statusMessage}}'">
                        <span class="moduleOrder"><?php echo Yii::t('course', '0364') ?> {{$index+1}}.</span>
                        <span class="moduleLink">{{module.moduleInCourse[titleParam]}}</span>
                        <div class="moduleProgress">
                            <span ng-if="module.progress!='finished' || !courseProgress.courseStatus">
                                <?php echo Yii::t('module', '0647') ?>: {{module.duration}} {{daysTermination(module.duration)}}.
                            </span>
                            <span ng-if="module.access && courseProgress.courseStatus">
                                <span ng-if="module.progress=='queue'">
                                    <?php echo Yii::t('module', '0648') ?>
                                </span>
                                <span ng-if="module.progress=='inProgress'">
                                    <?php echo Yii::t('module', '0650') ?> {{module.spentTime}} {{daysTermination(module.spentTime)}}.
                                    <?php echo Yii::t('module', '0651') ?>
                                </span>
                                <span ng-if="module.progress=='finished'">
                                    <span class="greenFinished"><?php echo Yii::t('module', '0649') ?></span>
                                    (<?php echo Yii::t('module', '0650') ?>:
                                    <span ng-class="{greenFinished: module.spentTime<=module.duration, redFinished: module.spentTime>module.duration}"> {{module.spentTime}} {{daysTermination(module.spentTime)}}</span>
                                    <?php echo Yii::t('module', '0652') ?> {{module.duration}})
                                </span>
                            </span>
                            <img ng-src="{{(!courseProgress.user || !courseProgress.courseStatus) && basePath+'/images/module/'+courseProgress.ico || basePath+'/images/module/'+module.progress+'.png'}}"/>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div ng-cloak class="finishedCourse" ng-if="finishedCourse">
        <span class="greenFinished">
            <?php echo Yii::t('payments', '0605') ?>. <?php echo $model->getTitle(); ?>
            <br>
            <?php echo Yii::t('module', '0649') ?>
        </span>
        <br>
        (<?php echo Yii::t('module', '0650') ?>:
        <span ng-class="{greenFinished: courseProgress.fullTime<=courseProgress.recommendedTime, redFinished: courseProgress.fullTime>courseProgress.recommendedTime}"> {{courseProgress.fullTime}} {{daysTermination(courseProgress.fullTime)}}</span>
        <?php echo Yii::t('module', '0652') ?> {{courseProgress.recommendedTime}})
        <br>
        <?php echo Yii::t('course', '0809') ?>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'course', 'finished.png'); ?>"/>
    </div>
</div>
