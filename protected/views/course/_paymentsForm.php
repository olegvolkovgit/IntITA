<?php
if ($model->isReadyOnline() || $model->isReadyOffline()) { ?>
    <div ng-show="onlineSchemeData && offlineSchemeData && status">
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

        <a href="<?php echo Yii::app()->createUrl('course/schemes', array('id' => $model->course_ID)); ?>"
           style="color:green;text-decoration:underline" target="_blank"><em>Спеціальні пропозиції</em></a>

        <div class="markAndButton">
            <div class="markCourse">
                <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
                <span><?php echo CommonHelper::getRating($model->rating); ?></span>
            </div>
            <div class="startCourse">
                <?php
                if (Yii::app()->user->isGuest) {
                    echo CHtml::button(Yii::t('course', '0328'), array('class' => "paymentButton",
                        'onclick' => 'openSignIn();'));
                } else {
                    if ($model->isReadyOnline() || $model->isReadyOffline()) {
                        ?>
                        <input type="button" ng-cloak
                               ng-if="!((status=='payable') || (status=='paid') && (status!='no_agreement'))"
                               ng-class="{'expired': (status=='expired'), 'warning': (status=='delay'), 'paymentButton' : true}"
                               ng-click="redirectToCabinet('payCourse',<?php echo $model->course_ID ?>,selectedScheme)"
                               ng-value="(status=='delay' || status=='expired')? 'ПРОДОВЖИТИ КУРС />':'<?php echo Yii::t('course', '0328'); ?>'">
                        <?php
                    }
                } ?>
            </div>
        </div>
    </div>
<?php } ?>
