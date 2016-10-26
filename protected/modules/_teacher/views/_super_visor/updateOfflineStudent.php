<div class="panel-body">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/supervisor/offlineStudents">
                Оффлайн студенти
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/supervisor/studentProfile/{{offlineStudent.id_user}}">
                Профіль студента
            </a>
        </li>
        <li>
            <a ng-if=!offlineStudent.endDate type="button" class="btn btn-primary" ng-click="cancelStudentFromSubgroup(offlineStudent.id_user,offlineStudent.idSubgroup)">
                Виключити студента з групи
            </a>
        </li>
    </ul>
</div>
<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-init="loadOfflineStudentData()" ng-submit="updateOfflineStudent(offlineStudent.id_user,offlineStudent.idSubgroup,offlineStudent.startDate,offlineStudent.graduateDate)" name="updateStudent"  novalidate>
                    <div class="form-group">
                        <label>Студент:</label>
                        <input class="form-control" ng-model="student.fullName" required maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group">
                        <label>Група:</label>
                        <input class="form-control" ng-model="offlineStudent.groupName" required maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group">
                        <label>Підгрупа:</label>
                        <input class="form-control" ng-model="offlineStudent.subgroupName" required maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group">
                        <label>Дата додавання студента в групу*</label>
                        <input ng-disabled=offlineStudent.endDate type="text" id="start_date" ng-model="offlineStudent.startDate" name="start_date" ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="addStudent['start_date'].$dirty && addStudent['start_date'].$invalid">
                            <span ng-show="addStudent['start_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addStudent['start_date'].$error.pattern">Введи дату додавання студента в групу в форматі рррр-мм-дд</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Дата випуску:</label>
                        <input ng-disabled=offlineStudent.endDate type="text" id="graduate_date" ng-model="offlineStudent.graduateDate" name="graduate_date" ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="updateStudent['graduate_date'].$dirty && updateStudent['graduate_date'].$invalid">
                            <span ng-show="updateStudent['graduate_date'].$error.pattern">Введи дату випуску студента в форматі рррр-мм-дд</span>
                        </div>
                    </div>
                    <div class="form-group" ng-if=offlineStudent.endDate>
                        <label>Дата скасування:</label>
                        <input class="form-control" ng-model="offlineStudent.endDate" maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group" ng-if=!offlineStudent.endDate >
                        <button type="submit" class="btn btn-primary" ng-disabled="updateStudent.$invalid">Зберегти
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        $jq("#start_date").datepicker(lang);
        $jq("#graduate_date").datepicker(lang);
    });
</script>