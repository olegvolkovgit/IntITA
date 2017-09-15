<?php
/**
 * Created by PhpStorm.
 * User: Adm
 * Date: 14.09.2017
 * Time: 12:29
 */
?>
<div class="row" ng-controller="studentProgressCtrl">
    <div class="panel panel-default">
        <div class="panel-body" class="ng-cloak">
            <div class="row" ng-repeat="row in data">
                <label class="progress-labe col-sm-4"style="float: left;"><a ui-sref="students/courseProgress/:studentId/:courseId({studentId:row.user_id,courseId:row.course_id})">Лекція: {{row.lecture}} </a> </label>
                <div class="col-sm-6"><uib-progressbar  max="100" v
                                                        value="row.progress"
                                                        ng-attr-type="{{(row.progress < 33) && 'danger' || (row.progress < 66) && 'warning' || 'success' }}"

                    >
                        {{row.progress}}%</uib-progressbar></div>
            </div>
        </div>
    </div>
</div>
