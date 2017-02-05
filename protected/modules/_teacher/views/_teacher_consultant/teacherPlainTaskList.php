<div class="panel-body">
    <div ng-controller="teacherConsultantTasksCtrl">
        <form autocomplete="off">
            <table ng-table="tasksTableParams" class="table table-bordered table-striped table-condensed">
                <tr ng-repeat="row in $data track by $index" ng-class="{success: row.plainTaskMark.mark, danger: row.plainTaskMark && !row.plainTaskMark.mark}">
                    <td data-title="'Модуль'" filter="{'plainTaskModule.title_ua': 'text'}" sortable="'plainTaskModule.title_ua'">
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
                    <td data-title="'Завдання'" filter="{'plainTaskQuestion.html_block': 'text'}">
                        {{row.plainTaskQuestion.html_block | htmlToShotPlaintext}}
                    </td>
                    <td data-title="'Студент'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                        <a ng-href="#/users/profile/{{row.user.id}}">
                            {{row.user.fullName}} {{row.user.email}}
                        </a>
                    </td>
                    <td data-title="'Відповідь'" filter="{'answer': 'text'}">
                        <a ng-href="#/teacherConsultant/task/{{row.id}}">
                            {{row.answer | textToShotPlaintext}}
                        </a>
                    </td>
                    <td data-title="'Дата'" filter="{'date': 'text'}" sortable="'date'">
                        {{row.date}}
                    </td>
                    <td data-title="'Оцінка'" filter="{'plainTaskMark.mark': 'select'}" filter-data="marks">
                        <span ng-if="row.plainTaskMark.mark==1">зарах.</span>
                        <span ng-if="row.plainTaskMark && !row.plainTaskMark.mark">не зарах.</span>
                        <span ng-if="!row.plainTaskMark">не перевірено</span>
                    </td>
                    <td data-title="'Коментар'" filter="{'plainTaskMark.comment': 'text'}">
                        {{row.plainTaskMark.comment  | textToShotPlaintext}}
                    </td>
                    <td data-title="'Викладач'" filter="{'markedBy.fullName': 'text'}">
                        {{row.markedBy.fullName}} {{row.markedBy.email}}
                    </td>
                    <td data-title="'Дата оцінювання'" filter="{'plainTaskMark.time': 'text'}" sortable="'plainTaskMark.time'">
                        {{row.plainTaskMark.time}}
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>