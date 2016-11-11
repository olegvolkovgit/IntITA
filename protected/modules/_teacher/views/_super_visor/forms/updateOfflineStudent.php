<div class="panel-body">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/supervisor/offlineStudents">
                Офлайн студенти
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/supervisor/userProfile/{{studentModel.id}}">
                Профіль студента
            </a>
        </li>
        <li>
            <a ng-if=!studentModel.endDate type="button" class="btn btn-primary" ng-click="cancelStudentFromSubgroup(studentModel.id,studentModel.idSubgroup)">
                Виключити студента з підгрупи
            </a>
        </li>
    </ul>
</div>
<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-init="loadOfflineStudentData(studentId)" ng-submit="updateOfflineStudent(studentModelId, studentModel.id,studentModel.idSubgroup,selectedSubgroup.id,studentModel.startDate,studentModel.graduateDate)" name="updateStudent"  novalidate>
                    <div class="form-group">
                        <label>Студент:</label>
                        <input class="form-control" ng-model="studentModel.fullName" required maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group">
                        <label>Група:</label>
                        <input class="form-control" ng-model="studentModel.groupName" required maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group">
                        <label>Підгрупа*</label>
                        <select ng-disabled=studentModel.endDate class="form-control" ng-options="subgroup as subgroup.name for subgroup in subgroupsList track by subgroup.id" ng-model="selectedSubgroup" required>
                            <option value="" disabled selected>(Виберіть підгрупу)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Дата додавання студента в групу*</label>
                        <input ng-disabled=studentModel.endDate type="text" id="start_date" ng-model="studentModel.startDate" name="start_date" ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="addStudent['start_date'].$dirty && addStudent['start_date'].$invalid">
                            <span ng-show="addStudent['start_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addStudent['start_date'].$error.pattern">Введи дату додавання студента в групу в форматі рррр-мм-дд</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Дата випуску:</label>
                        <input ng-disabled=studentModel.endDate type="text" id="graduate_date" ng-model="studentModel.graduateDate" name="graduate_date" ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" value=""/>
                        <div ng-cloak  class="clientValidationError" ng-show="updateStudent['graduate_date'].$dirty && updateStudent['graduate_date'].$invalid">
                            <span ng-show="updateStudent['graduate_date'].$error.pattern">Введи дату випуску студента в форматі рррр-мм-дд</span>
                        </div>
                    </div>
                    <div class="form-group" ng-if=studentModel.endDate>
                        <label>Дата скасування:</label>
                        <input class="form-control" ng-model="studentModel.endDate" maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group" ng-if=!studentModel.endDate >
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