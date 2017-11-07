<div class="panel panel-default" ng-controller="agreementsForGroupCtrl">
    <div class="panel-body">
        <div class="form-group">
            <label>Курси*:</label>
            <select class="form-control" ng-options="item as item.service.description for item in courseServices"
                    ng-model="selectedCourseService" ng-change="setService('course',selectedCourseService.course.course_ID)">
                <option value="" disabled selected>(Виберіть курс)</option>
            </select>
        </div>
        <div class="form-group">
            <label>Модулі*:</label>
            <select class="form-control" ng-options="item as item.service.description for item in moduleServices"
                    ng-model="selectedModuleService" ng-change="setService('module',selectedModuleService.module.module_ID)">
                <option value="" disabled selected>(Виберіть модуль)</option>
            </select>
        </div>
        <div id="agreementBlock" ng-show="selectedContent">
            <div style="overflow: hidden">
                Онлайн:
                <payments-scheme
                        data-content-id="selectedContent"
                        data-service-type="serviceType"
                        data-education-form="online"
                        data-schemes="onlineSchemeData"
                        data-selected-model-scheme="selectedScheme"
                        data-set-form="setForm"
                        data-set-scheme="schemeId"
                        data-user="1"
                >
                </payments-scheme>
                Офлайн:
                <payments-scheme
                        data-content-id="selectedContent"
                        data-service-type="serviceType"
                        data-education-form="offline"
                        data-schemes="offlineSchemeData"
                        data-selected-model-scheme="selectedScheme"
                        data-set-form="setForm"
                        data-set-scheme="schemeId"
                        data-user="1"
                >
                </payments-scheme>
            </div>
            <div>
                <span class="control-label">Шаблон паперового договору (при виборі буде застосовано шаблон)</span>
            </div>
            <div>
                <select
                        required="required"
                        class="form-control"
                        ng-model="formData.written_agreement_template_id"
                        ng-options="template.id as template.name for template in templates">
                    <option value="">Шаблон договору не вибрано</option>
                </select>
            </div>
        </div>
        <label>Застосувати на всіх студентів: <input type="checkbox" ng-model="allStudents"></label><br/>
        <div style="padding: 10px">
            <button class="btn btn-success"
                    ng-click="createStudentsAgreement(selectedModuleService.module.module_ID,
                    selectedCourseService.course.course_ID,serviceType, selectedScheme, formData.written_agreement_template_id,
                    allStudents,  selectedStudents)"
                    ng-disabled="!selectedScheme || disabledButton">Застосувати</button>
        </div>
        <table ng-table="offlineStudentsTableParams" class="table table-bordered table-striped table-condensed">
            <colgroup>
                <col width="20%"/>
                <col/>
                <col width="10%"/>
                <col width="10%"/>
                <col/>
                <col width="10%"/>
                <col width="10%"/>
                <col/>
                <col width="5%"/>
            </colgroup>
            <tr ng-repeat="row in $data track by $index">
                <td style="word-wrap:break-word" data-title="'Студент'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                    <a ng-href="#/users/profile/{{row.id_user}}">{{row.user.fullName}}</a>
                </td>
                <td data-title="'Тренер'" filter="{'trainerData.fullName': 'text'}" sortable="'trainerData.fullName'">
                    <a ng-href="#/users/profile/{{row.trainerData.id}}">{{row.trainerData.fullName}}</a>
                </td>
                <td data-title="'Навчальна зміна'" filter="{'user.education_shift': 'select'}" filter-data="shifts">
                    <span ng-if="row.user.education_shift==1">ранкова</span>
                    <span ng-if="row.user.education_shift==2">вечірня</span>
                    <span ng-if="row.user.education_shift==3">байдуже</span>
                </td>
                <td data-title="'Група'" filter="{'group.name': 'text'}" sortable="'group.name'">
                   {{row.group.name}}
                </td>
                <td data-title="'Підгрупа'" sortable="'subgroupName.name'" filter="{'subgroupName.name': 'text'}" >
                    {{row.subgroupName.name}}
                </td>
                <td data-title="'Додано'" sortable="'start_date'" filter="{'start_date': 'text'}">
                    {{row.start_date}}
                </td>
                <td data-title="'Випуск'" sortable="'graduate_date'" filter="{'graduate_date': 'text'}">
                    {{row.graduate_date}}
                </td>
                <td style="word-wrap:break-word;" data-title="'Телефон'" sortable="'user.phone'" filter="{'user.phone': 'text'}">
                    {{row.user.phone}}
                </td>
                <td><input type="checkbox" ng-model="checkboxes.items[row.id_user]" class="studentCheck"/></td>
            </tr>
        </table>
    </div>
</div>