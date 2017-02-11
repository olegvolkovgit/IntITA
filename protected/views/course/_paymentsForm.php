<?php
if ($model->isReady()   ) { ?>
    <div ng-show="onlineSchemeData && offlineSchemeData">
        <div ng-if="onlineSchemeData.schemes[0].fullPrice==0">
            {{onlineSchemeData.translates.price}} <span class="colorGreen">{{onlineSchemeData.translates.free}}</span>
        </div>
        <div ng-show="onlineSchemeData.schemes[0].fullPrice!=0">
            <span ng-click="isOpenOnlineSchema = !isOpenOnlineSchema" ng-show="!isOpenOnlineSchema" class="paymentsOnlineSpoiler">
                <?php echo Yii::t('course', '0414'); ?>&#9662;
            </span>
            <span ng-click="isOpenOnlineSchema = !isOpenOnlineSchema" ng-show="isOpenOnlineSchema" class="paymentsOnlineSpoiler">
                <?php echo Yii::t('course', '0415'); ?>&#9652;
            </span>
            <div  ng-show="!isOpenOnlineSchema" class="mainPay">
                <?php $this->renderPartial('_selectedOnlineScheme', array()); ?>
            </div>
            <div  ng-show="isOpenOnlineSchema">
                <payments-scheme
                    data-content-id="<?php echo $model->course_ID ?>"
                    data-service-type="'course'"
                    data-education-form="online"
                    data-schemes="onlineSchemeData"
                    data-selected-model-scheme="selectedScheme"
                    data-set-form="setForm"
                    data-set-scheme="schemeId"
                >
                </payments-scheme>
            </div>
        </div>

        <div ng-show="offlineSchemeData.schemes[0].fullPrice!=0">
            <span ng-click="isOpenOfflineSchema = !isOpenOfflineSchema" ng-show="!isOpenOfflineSchema" class="paymentsOfflineSpoiler">
                <?php echo Yii::t('course', '0819'); ?>&#9662;
            </span>
            <span ng-click="isOpenOfflineSchema = !isOpenOfflineSchema" ng-show="isOpenOfflineSchema" class="paymentsOfflineSpoiler">
                <?php echo Yii::t('course', '0415'); ?>&#9652;
            </span>
            <div ng-show="!isOpenOfflineSchema" class="mainPay">
                <?php $this->renderPartial('_selectedOfflineScheme', array()); ?>
            </div>
            <div  ng-show="isOpenOfflineSchema">
                <payments-scheme
                    data-content-id="<?php echo $model->course_ID ?>"
                    data-service-type="'course'"
                    data-education-form="offline"
                    data-schemes="offlineSchemeData"
                    data-selected-model-scheme="selectedScheme"
                    data-set-form="setForm"
                    data-set-scheme="schemeId"
                >
                </payments-scheme>
            </div>
        </div>


        <div class="markAndButton">
            <div class="markCourse">
                <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
                <span><?php echo CommonHelper::getRating($model->rating); ?></span>
            </div>
            <div class="startCourse">
                <?php
                if (Yii::app()->user->isGuest) {
                    echo CHtml::button(Yii::t('course', '0328'), array('id' => "paymentButton",
                        'onclick' => 'openSignIn();'));
                } else {
                    if ($model->isReady()) {
                        ?>
                        <a ng-cloak ng-if="modulesProgress.isPaidCourse==false" id="paymentButton"
                           ng-click="redirectToCabinet('payCourse',<?php echo $model->course_ID ?>,selectedScheme)">
                            <?php echo Yii::t('course', '0328'); ?>
                        </a>
                        <?php
                    }
                } ?>
            </div>
        </div>
    </div>
<?php } ?>
