<? $css_version = 1; ?>
<?php
/* @var $model Course
 */
?>
<?php
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        Course::getCourseTitleForBreadcrumbs($model->course_ID) => Yii::app()->createUrl('course/index', array('id' => $model->course_ID)),
        'Спеціальні пропозиції',
    );
?>
<script type="text/javascript">
    idCourse = <?php echo $model->course_ID;?>;
</script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'schemes.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers/moduleListCtrl.js'); ?>"></script>
<div class="mainContent" ng-controller="promotionSchemesCtrl" ng-cloak>
    <div ng-repeat="item in promotions track by $index">
        <div style="overflow: hidden;">
            <div ng-if="onlineSchemeData && offlineSchemeData" style="text-align: center;clear:both">
                <h3>{{item.template.name}}</h3>
                <em style="color:red">{{item.template.description}}</em>
                <div ng-if="item.promotion.startDate || item.promotion.endDate" style="overflow:hidden">
                    <em style="color:red;float:right">
                        Акція діє <span ng-if="item.promotion.startDate">з {{item.promotion.startDate}}</span>
                        <span ng-if="item.promotion.endDate"> по {{item.promotion.endDate}}</span>
                    </em>
                </div>
            </div>
            <div class="courseShortInfoTable" style="width:45%;float:left; max-width:inherit">
                <div ng-if="onlineSchemeData" style="text-align: center">
                    <h3><?php echo 'Online' ?></h3>
                </div>
                <payments-scheme-by-template
                    data-content-id="<?php echo $model->course_ID ?>"
                    data-service-type="'course'"
                    data-education-form="online"
                    data-schemes="onlineSchemeData"
                    data-scheme-template="item.promotion.id_template"
                >
                </payments-scheme-by-template>
            </div>
            <div class="courseShortInfoTable" style="width:45%;float:right;max-width:inherit">
                <div ng-if="offlineSchemeData" style="text-align: center">
                    <h3><?php echo 'Offline' ?></h3>
                </div>
                <payments-scheme-by-template
                    data-content-id="<?php echo $model->course_ID ?>"
                    data-service-type="'course'"
                    data-education-form="offline"
                    data-schemes="offlineSchemeData"
                    data-scheme-template="item.promotion.id_template"
                >
                </payments-scheme-by-template>
            </div>
        </div>
    </div>
</div>
