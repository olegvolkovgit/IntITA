<script type="text/ng-template" id="headerCheckbox.html">
    <input type="checkbox" ng-model="checkboxes.checkAll" id="select_all" name="filter-checkbox" value="" />
</script>
<div class="panel-body">
    <div ng-controller="teacherConsultantTasksCtrl">
        <label>
            <input type="checkbox" ng-model="isDetail">Режим перевірки
        </label>
        <label>
            <input type="checkbox" ng-model="isLatex" ng-click="renderTableListWithLatex()">Режим рендеру LaTeX формул
        </label>
        <form autocomplete="off">
            <div style="height: 50px">
                <div ng-if="checkedStudentsAnswers.length > 0" style="padding: 10px; text-align: right">
                    <button class="btn btn-primary"  ng-click="setMarkTaskInTableForChecked(checkedStudentsAnswers, 1)">Зарахувати</button>
                    <button class="btn btn-danger"  ng-click="setMarkTaskInTableForChecked(checkedStudentsAnswers, 0)">Не зарахувати</button>
                </div>
            </div>
            <table ng-table="tasksTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col ng-if="!isDetail"/>
                    <col ng-if="!isDetail"/>
                    <col/>
                    <col ng-if="!isDetail"/>
                    <col ng-class="{largeWidth: isDetail}"/>
                    <col ng-class="{largeWidth: isDetail}"/>
                    <col ng-if="!isDetail"/>
                    <col width="8%"/>
                    <col ng-if="!isDetail"/>
                    <col ng-if="!isDetail"/>
                    <col ng-if="!isDetail"/>
                    <col width="5%" />
                </colgroup>
                <tr ng-repeat="row in $data track by $index" ng-class="{success: row.plainTaskMark.mark, danger: row.plainTaskMark && !row.plainTaskMark.mark}">
                    <td ng-if="!isDetail" data-title="'Модуль'" filter="{'plainTaskModule.title_ua': 'text'}" sortable="'plainTaskModule.title_ua'">
                        <a ng-if="row.plainTaskModule.title_ua" href="javascript:void(0);" ng-click="moduleLink(row.plainTaskModule.module_ID)">
                            {{row.plainTaskModule.title_ua}}
                        </a>
                        <span ng-if="!row.plainTaskModule.title_ua">скасовано</span>
                    </td>
                    <td ng-if="!isDetail" data-title="'Заняття'" filter="{'plainTaskLecture.title_ua': 'text'}" sortable="'plainTaskLecture.title_ua'">
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
                    <td ng-if="!isDetail" data-title="'Група'" filter="{'studentsCategory.id': 'select'}" filter-data="studentsCategoriesList">
                        {{row.studentsCategory.title}}
                    </td>
                    <td data-title="'Завдання'" filter="{'plainTaskQuestion.html_block': 'text'}">
                        <a ng-href="#/teacherConsultant/task/{{row.id}}">
                            {{row.plainTaskQuestion.html_block | htmlToShotPlaintext : isDetail}}
                        </a>
                    </td>
                    <td data-title="'Відповідь'" filter="{'answer': 'text'}">
                        <a ng-href="#/teacherConsultant/task/{{row.id}}">
                            {{row.answer | textToShotPlaintext : isDetail}}
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
                            <a title="зараховано" href="" ng-click="setMarkTaskInTable(row.id, 1)"><i class="fa fa-check fa-fw"></i></a>
                            <a title="не зараховано" href="" ng-click="setMarkTaskInTable(row.id, 0)"><i class="fa fa-times fa-fw"></i></a>
                        </div>
                    </td>
                    <td ng-if="!isDetail" data-title="'Коментар'" filter="{'plainTaskMark.comment': 'text'}">
                        {{row.plainTaskMark.comment  | textToShotPlaintext: isDetail}}
                    </td>
                    <td ng-if="!isDetail" data-title="'Викладач'" filter="{'markedBy.fullName': 'text'}">
                        {{row.markedBy.fullName}}
                    </td>
                    <td ng-if="!isDetail" data-title="'Дата оцінювання'" filter="{'plainTaskMark.time': 'text'}" sortable="'plainTaskMark.time'">
                        {{row.plainTaskMark.time}}
                    </td>
                    <td header="'headerCheckbox.html'"> <input type="checkbox" ng-model="checkboxes.items[row.id]" /></td>
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