<?php
/* @var $levels array
 * @var $level Level
 */
?>
<div class="col-lg-12" ng-controller="levelsCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="tableParams" class="table table-striped table-bordered table-hover" style="table-layout: fixed">
                    <tr ng-repeat="row in $data">
                        <td data-title="'Рівень (рейтинг)'" style="width: ">{{row.id}}</td>
                        <td data-title="'Назва українською'" ><a href="#/configuration/levels/edit/{{row.id}}">{{row.title_ua}}</a></td>
                        <td data-title="'Назва англійською'"><a href="#/configuration/levels/edit/{{row.id}}">{{row.title_en}}</a></td>
                        <td data-title="'Назва російською'"><a href="#/configuration/levels/edit/{{row.id}}">{{row.title_ru}}</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>