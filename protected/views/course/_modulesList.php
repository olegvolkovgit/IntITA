<script type="text/javascript">
    basePath = '<?php echo Config::getBaseUrl();?>';
</script>
<div class="courseModules">
    <?php
    if ($isEditor) { ?>
        <div class="revisionIco">
            <label>Ревізії:
                <a href="<?php echo Yii::app()->createUrl('/courseRevision/courseRevisions', array('idCourse'=>$model->course_ID)); ?>">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'courseRevisions.png'); ?>"
                         title="Ревізії курса"/>
                </a>
                <a href="<?php echo Yii::app()->createUrl('/moduleRevision/courseModulesRevisions', array('idCourse'=>$model->course_ID)); ?>">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'moduleRevisions.png'); ?>"
                         title="Ревізії модулів курса"/>
                </a>
            </label>
        </div>
    <?php }?>
    <h2><?php echo Yii::t('course', '0330'); ?></h2>
    <img style="display:inline-block" id="modulesLoading" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'loading.gif'); ?>"/>
    <div ng-cloak id="modulesList">
        <div ng-repeat="module in modulesProgress.modules track by $index">
            <div class="modulesTitle"
                 ng-class="{disableModuleStyle: (!module.access || !modulesProgress.courseStatus) && !module.isAuthor && !modulesProgress.isAdmin,
                 availableModuleStyle: (module.access && modulesProgress.courseStatus) || module.isAuthor || modulesProgress.isAdmin,
                 inProgressModuleStyle: module.progress=='inProgress',
                 inlineModuleStyle: module.progress=='inLine',
                 inFinishedModuleStyle: module.progress=='finished'}">
                <a href="{{module.link}}">
                <span class="moduleOrder"><?php echo Yii::t('course', '0364') ?> {{$index+1}}.</span>
                <span class="moduleLink">{{module.title}}</span>
                <div class="moduleProgress">
                    <span ng-if="module.progress!='finished' || (modulesProgress.isAdmin || module.isAuthor || !modulesProgress.courseStatus)"><?php echo Yii::t('module', '0647') ?>: {{module.time}} {{daysTermination(module.time)}}.</span>
                    <span ng-if="module.access && modulesProgress.courseStatus && !(modulesProgress.isAdmin || module.isAuthor)">
                        <span ng-if="module.progress=='inLine'">
                            <?php echo Yii::t('module', '0648') ?>
                        </span>
                        <span ng-if="module.progress=='inProgress'">
                            <?php echo Yii::t('module', '0650') ?> {{module.spentTime}} {{daysTermination(module.spentTime)}}.
                            <?php echo Yii::t('module', '0651') ?>
                        </span>
                        <span ng-if="module.progress=='finished'">
                            <span class="greenFinished"><?php echo Yii::t('module', '0649') ?></span>
                            (<?php echo Yii::t('module', '0650') ?>:
                            <span ng-class="{greenFinished: module.spentTime<=module.time, redFinished: module.spentTime>module.time}"> {{module.spentTime}} {{daysTermination(module.spentTime)}}</span>
                            <?php echo Yii::t('module', '0652') ?> {{module.time}})
                        </span>
                    </span>
                    <img ng-if="!(modulesProgress.isAdmin || module.isAuthor)" ng-src="{{(!modulesProgress.userId || !modulesProgress.courseStatus)&& basePath+'/images/module/'+modulesProgress.ico || basePath+'/images/module/'+module.ico}}"/>
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
        <span ng-class="{greenFinished: modulesProgress.fullTime<=modulesProgress.recommendedTime, redFinished: modulesProgress.fullTime>modulesProgress.recommendedTime}"> {{modulesProgress.fullTime}} {{daysTermination(modulesProgress.fullTime)}}</span>
        <?php echo Yii::t('module', '0652') ?> {{modulesProgress.recommendedTime}})
        <br>
        <?php echo Yii::t('course', '0809') ?>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'course', 'finished.png'); ?>"/>
    </div>
</div>
