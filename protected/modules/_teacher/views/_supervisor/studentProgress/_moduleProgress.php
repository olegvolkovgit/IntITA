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
                <label class="progress-labe col-sm-4"style="float: left;"><a ui-sref="students/lectureProgress/:studentId/:lecture({studentId:student.id,lecture:row.id_lecture})">Лекція: {{row.lecture}} </a> </label>
                <div class="col-sm-6"><uib-progressbar  max="row.progress.lecturePages"
                                                        value="row.progress.passedPages"
                                                        ng-attr-type="{{((row.progress.passedPages/row.progress.lecturePages *100) < 33) && 'danger' || ((row.progress.passedPages/row.progress.lecturePages *100) < 66) && 'warning' || 'success' }}">
                        {{(row.progress.isDone) && 'Завершено' || 'Пройдено занять  ' + row.progress.lecturePages + ' з ' + row.progress.lecturePages }}
                        </uib-progressbar></div>
            </div>
        </div>
    </div>
</div>
