<div class="panel panel-default" ng-controller="studentPlainTaskViewCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <table ng-table="studentPlainTasksAnswersTable" class="table table-striped table-bordered table-hover">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col width="8%"/>
                    <col width="10%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index" ng-class="{success: row.plainTaskMark.mark, danger: row.plainTaskMark && !row.plainTaskMark.mark}">
                    <td data-title="'Завдання'">
                        {{row.plainTaskQuestion.html_block | htmlToPlaintext}}
                    </td>
                    <td data-title="'Відповідь'">
                        {{row.answer}}
                    </td>
                    <td data-title="'Коментар'">
                        {{row.plainTaskMark.comment}}
                    </td>
                    <td data-title="'Оцінка'">
                        <span ng-if="row.plainTaskMark.mark==1">зарах.</span>
                        <span ng-if="row.plainTaskMark && !row.plainTaskMark.mark">не зарах.</span>
                        <span ng-if="!row.plainTaskMark">не перевірено</span>
                    </td>
                    <td data-title="'Викладач'" >
                        <a href="/profile/{{row.markedBy.id}}" target="_blank">
                            {{row.markedBy.fullName}}
                        </a>
                        <a class="btnChat" ng-if="row.markedBy.id" ng-href="#/newmessages/receiver/{{row.markedBy.id}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <a class="btnChat" ng-if="row.markedBy.id" href="<?php echo Config::getChatPath(); ?>{{row.markedBy.id}}" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                            <i class="fa fa-weixin fa-fw"></i>
                        </a>
                    </td>
                </tr>
            </table>
            <div class="form-group">
                <a href="" type="button" class="btn btn-default" ng-click="back()">
                    Назад
                </a>
            </div>
        </div>
    </div>
</div>