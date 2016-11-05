<?php
if ($model->isReady()   ) { ?>
    <div ng-show="onlineSchemeData && offlineSchemeData">
        <div>
            <div ng-if="onlineSchemeData.schemes[0].fullPrice==0">
                {{onlineSchemeData.translates.price}} <span class="colorGreen">{{onlineSchemeData.translates.free}}</span>
            </div>
            <div ng-show="onlineSchemeData.schemes[0].fullPrice!=0">
                <span id="paymentsOnlineSpoiler" ng-hide="onlineSchemeData.schemes[0].fullPrice==0" ng-init="spoilerOnlineTitle='<?php echo Yii::t('course', '0414'); ?>&#9660;'" ng-click="paymentOnlineSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>', 'Online')">
                {{spoilerOnlineTitle}}
                </span>
                <table  ng-show="!isOpenOnlineSchema" class="mainPay">
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <div class="numbers" id="numbersFirstOnline">
                            <span class="coursePriceStatus1">
                                {{onlineSchemeData.schemes[0].translates.currencySymbol}}{{onlineSchemeData.schemes[0].fullPrice}}
                            </span>
                                            &nbsp
                            <span class="coursePriceStatus2">
                                {{onlineSchemeData.schemes[0].translates.currencySymbol}}{{onlineSchemeData.schemes[0].price}}
                            </span>
                            <span class="discount">
                                <img style="text-align:right" ng-src="{{onlineSchemeData.icons.discountIco}}"/>
                                ({{onlineSchemeData.schemes[0].translates.discount}} - {{onlineSchemeData.schemes[0].discount}}%)
                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div  ng-show="isOpenOnlineSchema">
                    <payments-scheme data-schemes="onlineSchemeData" data-other-schemes='offlineSchemeData'></payments-scheme>
                </div>
            </div>
        </div>

        <div  ng-show="offlineSchemeData.schemes[0].fullPrice!=0">
            <span id="paymentsOfflineSpoiler" ng-hide="offlineSchemeData.schemes[0].fullPrice==0" ng-init="spoilerOfflineTitle='<?php echo Yii::t('course', '0819'); ?>&#9660;'" ng-click="paymentOfflineSpoiler('<?php echo Yii::t('course', '0819'); ?>', '<?php echo Yii::t('course', '0415'); ?>', 'Offline')">
                {{spoilerOfflineTitle}}
            </span>
            <div ng-if="offlineSchemeData.schemes[0].fullPrice==0">
                {{offlineSchemeData.translates.price}} <span class="colorGreen">{{offlineSchemeData.translates.free}}</span>
            </div>
            <table ng-show="!isOpenOfflineSchema" class="mainPay">
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <div class="numbers" id="numbersFirstOffline">
                                    <span class="coursePriceStatus1">
                                        {{offlineSchemeData.schemes[0].translates.currencySymbol}}{{offlineSchemeData.schemes[0].fullPrice}}
                                    </span>
                                        &nbsp
                                    <span class="coursePriceStatus2">
                                        {{offlineSchemeData.schemes[0].translates.currencySymbol}}{{offlineSchemeData.schemes[0].price}}
                                    </span>
                                    <span class="discount">
                                        <img style="text-align:right" ng-src="{{offlineSchemeData.icons.discountIco}}"/>
                                        ({{offlineSchemeData.schemes[0].translates.discount}} - {{offlineSchemeData.schemes[0].discount}}%)
                                    </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div  ng-show="isOpenOfflineSchema">
                <payments-scheme data-schemes="offlineSchemeData" data-other-schemes='onlineSchemeData'></payments-scheme>
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
                           ng-click="redirectToCabinet('payCourse',<?php echo $model->course_ID ?>)">
                            <?php echo Yii::t('course', '0328'); ?>
                        </a>
                        <?php
                    }
                } ?>
            </div>
        </div>
    </div>
<?php } ?>
