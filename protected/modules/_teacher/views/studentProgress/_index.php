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

            <div class="form-group row">
                <div class="col-xs-2 col-md-2 col-lg-2">
                    <input class="form-control col-md-3" type="text" id="searchField" ng-keypress="allpyFilter($event)" ng-model="filter" placeholder="Фільтр"/>
                </div>
                <button class="btn btn-primary" id="searchButton" ng-click="allpyFilter()">Пошук</button>
            </div>
            <div class="row" ng-repeat="row in data">
                <label class="progress-labe col-sm-4"style="float: left;"><a ui-sref="students/courseProgress/:studentId/:courseId({studentId:row.user_id,courseId:row.course_id})">Користувач: {{row.user}} <br /> Курс: {{row.course}} </a> </label>
                <div class="col-sm-6"><uib-progressbar
                                                        max="row.progress.modules"
                                                        value="row.progress.passedModules"
                                                        ng-attr-type="{{((row.progress.passedModules/row.progress.modules *100) < 33) && 'danger' || ((row.progress.passedModules/row.progress.modules *100) < 66) && 'warning' || 'success' }}">
                        {{(row.progress.isDone) && 'Завершено' || 'Пройдено модулів  ' + row.progress.passedModules + ' з ' + row.progress.modules }}
                        </uib-progressbar></div>
            </div>
            <ul uib-pagination total-items="totalItems"
                ng-model="currentPage"
                ng-change="pageChanged()"
                first-text="Перша"
                max-size="5"
                boundary-links="true"
                last-text="Остання"
                force-ellipses="true"
                previous-text="Попередня"
                next-text="Наступна">
            </ul>
        </div>
    </div>
</div>
