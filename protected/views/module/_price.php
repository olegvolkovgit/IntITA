<?php
if (!$model->isDeveloping()) { ?>
    <div ng-show="onlineSchemeData && offlineSchemeData">
        <div ng-if="onlineSchemeData.schemes[0].fullPrice==0">
            {{onlineSchemeData.translates.price}} <span class="colorGreen">{{onlineSchemeData.translates.free}}</span>
        </div>
        <div ng-show="onlineSchemeData.schemes[0].fullPrice!=0">
            <div ng-click="isOpenOnlineSchema = !isOpenOnlineSchema" ng-show="!isOpenOnlineSchema" class="paymentsOnlineSpoiler">
                <?php echo 'Ціна за весь модуль наперед (схеми проплат онлайн)' ?>&#9662;
            </div>
            <div ng-click="isOpenOnlineSchema = !isOpenOnlineSchema" ng-show="isOpenOnlineSchema" class="paymentsOnlineSpoiler">
                <?php echo Yii::t('course', '0415'); ?>&#9652;
            </div>
            <div  ng-show="!isOpenOnlineSchema" class="mainPay">
                <div><?php $this->renderPartial('_selectedOnlineScheme', array()); ?></div>
            </div>
            <div  ng-show="isOpenOnlineSchema">
                <payments-scheme
                    data-content-id="<?php echo $model->module_ID ?>"
                    data-service-type="'module'"
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
            <div ng-click="isOpenOfflineSchema = !isOpenOfflineSchema" ng-show="!isOpenOfflineSchema" class="paymentsOfflineSpoiler">
                <?php echo 'Ціна за весь модуль наперед (розгорнути схеми офлайн)' ?>&#9662;
            </div>
            <div ng-click="isOpenOfflineSchema = !isOpenOfflineSchema" ng-show="isOpenOfflineSchema" class="paymentsOfflineSpoiler">
                <?php echo Yii::t('course', '0415'); ?>&#9652;
            </div>
            <div ng-show="!isOpenOfflineSchema" class="mainPay">
                <div><?php $this->renderPartial('_selectedOfflineScheme', array()); ?></div>
            </div>
            <div  ng-show="isOpenOfflineSchema">
                <payments-scheme
                    data-content-id="<?php echo $model->module_ID ?>"
                    data-service-type="'module'"
                    data-education-form="offline"
                    data-schemes="offlineSchemeData"
                    data-selected-model-scheme="selectedScheme"
                    data-set-form="setForm"
                    data-set-scheme="schemeId"
                >
                </payments-scheme>
            </div>
        </div>
    </div>
<?php } ?>
<a href="<?php echo Yii::app()->createUrl('module/schemes', array('id' => $model->module_ID)); ?>"
   style="color:green;text-decoration:underline" target="_blank"><em>Спеціальні пропозиції</em></a>

