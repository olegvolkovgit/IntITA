<li>
    <a href="#/student" ng-controller="studentCtrl" class="show_elem">
        <i class="fa fa-child fa-fw"></i> Студент
        <span ng-cloak class="label label-success" ng-if="countOfNewPlainTasksMarks > 0">{{countOfNewPlainTasksMarks}}</span>
    </a>
    <a href="#/student" ng-controller="studentCtrl" uib-tooltip="Студент" tooltip-placement="right" class="hid" style="display: none">
        <i class="fa fa-child fa-fw"></i>
        <span ng-cloak class="label label-success" ng-if="countOfNewPlainTasksMarks > 0">{{countOfNewPlainTasksMarks}}</span>
    </a>
</li>