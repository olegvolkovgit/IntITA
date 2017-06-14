<?php
/**
 * @var $model Module
 * @var $teachers array
 * @var $item array
 * @var $scenario string
 */
?>
<div class="panel panel-default" ng-controller="moduleAuthorsTableCtrl">
    <div class="panel-body">
        <?php if (Yii::app()->user->model->isContentManager() && $scenario == "update") { ?>
            <ul class="list-inline">
                <li>
                    <a type="button" class="btn btn-outline btn-primary" ng-href="#/module/addAuthor/<?= $model->module_ID ?>">
                        Призначити автора
                    </a>
                </li>
            </ul>
        <?php } ?>
        <div class="dataTable_wrapper">
            <table ng-table="moduleAuthorsTable" class="table table-striped table-bordered table-hover">
                <tr ng-repeat="row in $data">
                    <td data-title="'Автор'" sortable="'user.fullName'" filter="{'user.fullName': 'text'}">
                        <a ng-href="#/users/profile/{{row.user.id}}" >
                            {{row.user.fullName}}
                        </a>
                    </td>
                    <td data-title="'Призначено'" sortable="'start_time'" filter="{start_time: 'text'}">{{row.start_time}}</td>
                    <td data-title="'Відмінено'" sortable="'end_time'" filter="{end_time: 'text'}" filter-data="lang">{{row.end_time}}</td>
                    <?php if (Yii::app()->user->model->isContentManager() && $scenario == 'update') { ?>
                    <td data-title="'Відмінити'">
                        <a ng-if="!row.end_time" href=""
                           ng-click="cancelTeacherRoleAttribute('author','module',row.idTeacher,row.idModule)">
                            скасувати
                        </a>
                    </td>
                    <?php } ?>
                </tr>
            </table>
        </div>
    </div>
</div>