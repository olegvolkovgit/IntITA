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
                <label class="progress-labe col-sm-4"style="float: left;"><a ng-attr-class="{{(row.progress.passedLectures == 0 && !row.progress.isDone ) && 'disabled'}}" ui-sref="students/moduleProgress/:studentId/:module({studentId:row.student,module:row.idModule})">Модуль: {{row.module}} </a> </label>
                <div class="col-sm-6"><uib-progressbar  max="((row.progress.lectures > 0)) && row.progress.lectures || 99999 "
                                                        value="row.progress.passedLectures"
                                                        ng-attr-type="{{((row.progress.passedLectures/row.progress.lectures *100) < 33) && 'danger' || ((row.progress.passedLectures/row.progress.lectures *100) < 66) && 'warning' || 'success' }}"
                    >{{(row.progress.isDone) && 'Завершено' || 'Пройдено занять  ' + row.progress.passedLectures + ' з ' + row.progress.lectures }}
                        </uib-progressbar></div>
            </div>
        </div>
    </div>
</div>
