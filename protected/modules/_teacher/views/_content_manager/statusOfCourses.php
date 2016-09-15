<div class="panel panel-default" ng-controller="statusOfModulesCtrl">
    <div class="panel-body">

        <uib-tabset active="0">
            <uib-tab index="0" heading="Всі курси" select="initCoursesList()">
                <?php $this->renderPartial('/_content_manager/_allCourses',array('filter_id'=>'0')); ?>
            </uib-tab>
            <uib-tab index="1" heading="Курси без відео" select="initCoursesWithoutVideos()">
                <?php $this->renderPartial('/_content_manager/_coursesWithoutVideos',array('filter_id'=>'1')); ?>
            </uib-tab>
            <uib-tab index="2" heading="Курси без тестів" select="initCoursesWithoutTests()">
                <?php $this->renderPartial('/_content_manager/_coursesWithoutTests',array('filter_id'=>'2')); ?>
            </uib-tab>
            <uib-tab index="3" heading="Курси без тестів і відео" select="initCoursesWithoutVideosAndTests()">
                <?php $this->renderPartial('/_content_manager/_coursesWithoutTestsAndVideos',array('filter_id'=>'3')); ?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>