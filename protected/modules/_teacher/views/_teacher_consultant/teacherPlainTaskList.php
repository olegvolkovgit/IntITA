<div class="panel-body">
    <div ng-controller="teacherConsultantTasksCtrl">
        <label>
            <input type="checkbox" ng-model="isDetail">Режим перевірки
        </label>
        <form autocomplete="off">
            <table ng-table="tasksTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col ng-if="!isDetail"/>
                    <col/>
                    <col/>
                    <col ng-class="{largeWidth: isDetail}"/>
                    <col ng-class="{largeWidth: isDetail}"/>
                    <col ng-if="!isDetail"/>
                    <col width="8%"/>
                    <col ng-if="!isDetail"/>
                    <col ng-if="!isDetail"/>
                    <col ng-if="!isDetail"/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index" ng-class="{success: row.plainTaskMark.mark, danger: row.plainTaskMark && !row.plainTaskMark.mark}">
                    <td ng-if="!isDetail" data-title="'Модуль'" filter="{'plainTaskModule.title_ua': 'text'}" sortable="'plainTaskModule.title_ua'">
                        <a ng-if="row.plainTaskModule.title_ua" href="javascript:void(0);" ng-click="moduleLink(row.plainTaskModule.module_ID)">
                            {{row.plainTaskModule.title_ua}}
                        </a>
                        <span ng-if="!row.plainTaskModule.title_ua">скасовано</span>
                    </td>
                    <td data-title="'Заняття'" filter="{'plainTaskLecture.title_ua': 'text'}" sortable="'plainTaskLecture.title_ua'">
                        <a ng-if="row.plainTaskLecture.title_ua" href="javascript:void(0);" ng-click="lectureLink(row.plainTaskLecture.id)">
                            {{row.plainTaskLecture.title_ua}}
                        </a>
                        <span ng-if="!row.plainTaskLecture.title_ua">скасовано</span>
                    </td>
                    <td data-title="'Студент'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                        <a ng-href="#/users/profile/{{row.user.id}}">
                            {{row.user.fullName}}
                        </a>
                    </td>
                    <td data-title="'Завдання'" filter="{'plainTaskQuestion.html_block': 'text'}">
                        {{row.plainTaskQuestion.html_block | htmlToShotPlaintext}}
                    </td>
                    <td data-title="'Відповідь'" filter="{'answer': 'text'}">
                        <a ng-href="#/teacherConsultant/task/{{row.id}}">
                            {{row.answer | textToShotPlaintext}}
                        </a>
                    </td>
                    <td ng-if="!isDetail" data-title="'Дата'" filter="{'date': 'text'}" sortable="'date'">
                        {{row.date}}
                    </td>
                    <td data-title="'Оцінка'" filter="{'plainTaskMark.mark': 'select'}" filter-data="marks" style="text-align:center">
                        <span ng-if="row.plainTaskMark.mark==1">+</span>
                        <span ng-if="row.plainTaskMark && !row.plainTaskMark.mark">-</span>
                        <span ng-if="!row.plainTaskMark">?</span>

                        <div ng-if="!row.plainTaskMark">
                            <a title="зараховано" href="" ng-click="setMarkTaskInTable(row.id, 1, row.user.id)"><i class="fa fa-check fa-fw"></i></a>
                            <a title="не зараховано" href="" ng-click="setMarkTaskInTable(row.id, 0,row.user.id)"><i class="fa fa-times fa-fw"></i></a>
                        </div>
                    </td>
                    <td ng-if="!isDetail" data-title="'Коментар'" filter="{'plainTaskMark.comment': 'text'}">
                        {{row.plainTaskMark.comment  | textToShotPlaintext}}
                    </td>
                    <td ng-if="!isDetail" data-title="'Викладач'" filter="{'markedBy.fullName': 'text'}">
                        {{row.markedBy.fullName}} {{row.markedBy.email}}
                    </td>
                    <td ng-if="!isDetail" data-title="'Дата оцінювання'" filter="{'plainTaskMark.time': 'text'}" sortable="'plainTaskMark.time'">
                        {{row.plainTaskMark.time}}
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<style>
    .largeWidth {
        width: 40%;
    }
</style>