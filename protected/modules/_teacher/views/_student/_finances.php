<div class="panel panel-default" ng-controller="studentCtrl">
    <div class="panel-body">
        <uib-tabset selected="0">
            <uib-tab heading="Договори" index="0" select="getStudentAreements()">
                <?php $this->renderPartial('/_student/_agreementsTable');?>
            </uib-tab>
            <uib-tab heading="Проплачені курси" index="1" select="getStudentPaidCourses()">
                <?php $this->renderPartial('/_student/_payCoursesTable');?>
            </uib-tab>
            <uib-tab heading="Проплачені модулі" index="2" select="getStudentPaidModues()">
                <?php $this->renderPartial('/_student/_payModulesTable');?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>




