<div ng-controller="visitInfoCtrl">
    <table ng-table="studentVisitInfoTableParams" class="table table-bordered table-striped table-condensed">
        <tr ng-repeat="row in $data track by $index">
            <td data-title="'Примітки'" filter="{'notes': 'text'}" sortable="'notes'">
                <a ng-href="" ng-click="updateVisitInfo(row.id_student ,'notes', row.notes)">{{ row.notes ? row.notes : 'Редагувати' }}</a>
            </td>
            <td style="word-wrap:break-word" data-title="'Імя'" filter="{'first_name': 'text'}" sortable="'first_name'">
                <a ng-href="" ng-click="updateVisitInfo(row.id_student ,'first_name', row.first_name)">{{ row.first_name ? row.first_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'По-батькові'" filter="{'middle_name': 'text'}" sortable="'middle_name'">
                <a ng-href="" ng-click="updateVisitInfo(row.id_student ,'middle_name', row.middle_name)">{{ row.middle_name ? row.middle_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'Прізвище'" filter="{'second_name': 'text'}" sortable="'second_name'">
                <a ng-href="" ng-click="updateVisitInfo(row.id_student ,'second_name', row.second_name)">{{ row.second_name ? row.second_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'Еmail'" filter="{'email': 'text'}">
                {{ row.email }}
            </td>
            <td data-title="'Група'" filter="{ 'group_name.id' : 'select' }" filter-data="groupsNames">
                <span ng-repeat="item in row.group_name">{{ item.name + ' ' }}</span>
            </td>
            <td data-title="'Бажана форма навчання'"  filter="{ 'studyForm.id' : 'select' }" filter-data="educationForm">
                <a href="" ng-click="studyOption(row.studyForm.id, row.id_student)">
                    {{ row.studyForm.title_ua ? row.studyForm.title_ua : 'Редагувати'}}
                </a>
            </td>
            <td data-title="'Бажана зміна'"  filter="{ 'studyTime.id': 'select' }" filter-data="educationTime">
                <a href="" ng-click="studyTime(row.studyTime.id, row.id_student)">
                    {{ row.studyTime.title_ua ? row.studyTime.title_ua : 'Редагувати' }}
                </a>
            </td>
            <td data-title="'Моб. телефон'" filter="{'mobile_phone': 'text'}" sortable="'mobile_phone'">
                <a ng-href="" ng-click="updateVisitInfo(row.id_student ,'mobile_phone', row.mobile_phone)">{{ row.mobile_phone ? row.mobile_phone : 'Редагувати' }}</a>
            </td>
            <td data-title="'Моб. телефон 2'" filter="{'mobile_phone_2': 'text'}" sortable="'mobile_phone_2'">
                <a ng-href="" ng-click="updateVisitInfo(row.id_student ,'mobile_phone_2', row.mobile_phone_2)">{{ row.mobile_phone_2 ? row.mobile_phone_2 : 'Редагувати' }}</a>
            </td>
            <td data-title="'Причини виключення з групи'" filter="{ 'reason.id' : 'select' }" filter-data="cancelType">
                <span ng-repeat="cancel in row.cancel_name">{{ cancel.description }}</span>

            </td>
            <td data-title="'Коли зручно дзвонити'" filter="{'time_call': 'text'}" sortable="'time_call'">
                <a ng-href="" ng-click="updateVisitInfo(row.id_student ,'time_call', row.time_call)">{{ row.time_call ? row.time_call : 'Редагувати' }}</a>
            </td>
            <td data-title="'Дата спілкування'" filter="{'date_converse': 'text'}" sortable="'date_converse'">
                <a ng-href="" ng-click="updateVisitInfo(row.id_student ,'date_converse', row.date_converse)">{{ row.date_converse ? row.date_converse : 'Редагувати' }}</a>
            </td>
        </tr>
    </table>
</div>