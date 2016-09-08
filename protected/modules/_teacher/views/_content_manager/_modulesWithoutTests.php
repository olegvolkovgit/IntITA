<div class="col-lg-12">
    <br>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="ModulesWithoutTests" class="table table-striped table-bordered table-hover" id="statusOfModulesTable">
                    <tr ng-repeat="row in $data">
                        <td style="width:30%;" data-title="'Назва модуля'">{{row.mit}}</td>
                        <td style="width:12%;" data-title="'К-ть занять'">{{row.countOfLectures}}</td>
                        <td style="width:12%;" data-title="'К-ть відео'">{{row.videos}}</td>
                        <td style="width:12%;" data-title="'К-ть тестів'">{{row.tests}}</td>
                        <td style="width:12%;" data-title="'К-ть частин'">{{row.parts}}</td>
                        <td style="width:12%;" data-title="'К-ть ревізій'">{{row.revisions}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
