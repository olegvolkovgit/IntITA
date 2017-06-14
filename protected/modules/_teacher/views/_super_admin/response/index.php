<div class="panel panel-default" ng-controller="responseCtrl">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="responsesTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col width="10%"/>
                    <col width="6%"/>
                    <col width="12%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index">
                    <td style="word-wrap:break-word" data-title="'Автор'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                        <a ng-href="#/users/profile/{{row.who}}">{{row.user.fullName}}</a>
                    </td>
                    <td style="word-wrap:break-word" data-title="'Про кого'" filter="{'teacher.fullName': 'text'}" sortable="'teacher.fullName'">
                        <a ng-href="#/users/profile/{{row.teacher.id}}">{{row.teacher.fullName}}</a>
                    </td>
                    <td data-title="'Відгук'" filter="{'text': 'text'}">
                        <a ng-href="#/response/detail/{{row.id}}">{{row.text | htmlToPlaintext}}</a>
                    </td>
                    <td data-title="'Дата відгуку'" filter="{'date': 'text'}" sortable="'date'">
                        {{row.date}}
                    </td>
                    <td data-title="'Оцінка'" filter="{'rate': 'text'}" sortable="'rate'">
                        {{row.rate}}
                    </td>
                    <td data-title="'Статус'" filter="{'is_checked': 'select'}" filter-data="responseStatuses">
                        <span ng-if="row.is_checked==1">опублікованно</span>
                        <span ng-if="row.is_checked==0">приховано</span>
                        <span ng-if="!row.is_checked">не перевірено</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>