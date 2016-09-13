<div class="fullpageaboutus">
    <div class="mainAboutBlock">
        <div class="mainAbout">
            <div class="header">
                <?php echo Yii::t('mainpage', '0002'); ?>
                <p>
                    <?php echo Yii::t('mainpage', '0006'); ?>
                </p>
            </div>

            <div class="line1">
                <div id="anchorAboutUs"></div>
            </div>
            <div id="maxTabs">
                <div ng-class="{block: 1, selectedTab: $index==openPage-1}" ng-repeat="tab in aboutUs track by $index"
                     id="tab.tabId" ng-click="showAboutUs($index+1,$event)">
                    <div class="icon">
                        <img ng-src="{{tab.imageLink}}">
                    </div>
                    <div class="title">
                        <div class="aboutTitleLink">
                            {{tab.titleTextExp}}
                        </div>
                    </div>
                </div>

            </div>
            <div id="minTabs">
                <div ng-show="$index==openPage-1" class="block" ng-repeat="tab in aboutUs track by $index" id="tab{{$index+1}}">
                    <div class="icon">
                        <img ng-src="{{tab.imageLink}}">
                    </div>
                    <div class="title">
                        <div class="aboutTitleLink">
                            {{tab.titleTextExp}}
                        </div>
                    </div>
                    <img ng-if="$index<2" ng-click="nextPage($index+2)" id="nextRow" src="<?php echo StaticFilesHelper::createImagePath('aboutus', 'next.png');?>">
                    <img ng-if="$index>0" ng-click="nextPage($index)" id="prevRow" src="<?php echo StaticFilesHelper::createImagePath('aboutus', 'prev.png');?>">
                </div>
            </div>

        </div>
    </div>
</div>