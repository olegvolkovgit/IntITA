<div ng-controller="personalInfoCtrl">
    <table ng-table="studentPersonalInfoTableParams" class="table table-bordered table-striped table-condensed">
        <tr ng-repeat="row in $data track by $index">
            <td data-title="'Примітки'" filter="{'notes': 'text'}" sortable="'notes'">
                <a href="" ng-click="updateStudentInfo(row.id_student, 'notes', row.notes)">{{ row.notes ? row.notes : "Редагувати" }}</a>
            </td>
            <td style="word-wrap:break-word" data-title="'Імя'" filter="{'first_name': 'text'}" sortable="'first_name'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'first_name', row.first_name)">{{ row.first_name ? row.first_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'По-батькові'" filter="{'middle_name': 'text'}" sortable="'middle_name'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'middle_name', row.middle_name)">{{ row.middle_name ? row.middle_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'Прізвище'" filter="{'second_name': 'text'}" sortable="'second_name'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'second_name', row.second_name)">{{ row.second_name ? row.second_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'Дата народження'" filter="{'birthday': 'text'}" sortable="'birthday'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'birthday', row.birthday)">{{ row.birthday ? row.birthday : 'Редагувати' }}</a>
            </td>
            <td data-title="'Моб. телефон'" filter="{'mobile_phone': 'text'}" sortable="'mobile_phone'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'mobile_phone', row.mobile_phone)">{{ row.mobile_phone ? row.mobile_phone : 'Редагувати' }}</a>
            </td>
            <td data-title="'Моб. телефон 2'" filter="{'mobile_phone_2': 'text'}" sortable="'mobile_phone_2'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'mobile_phone_2', row.mobile_phone_2)">{{ row.mobile_phone_2 ? row.mobile_phone_2 : 'Редагувати' }}</a>
            </td>
            <td data-title="'Еmail'" filter="{'email': 'text'}">
                <a ng-href="#/users/profile/{{row.id_student}}">{{row.email}}</a>
            </td>
<!--                    <td data-title="'Еmail INTITA'">-->
<!--                        {{ row.email_intita }}-->
<!--                    </td>-->
            <td data-title="'Домашня адреса'" filter="{'address': 'text'}" sortable="'address'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'address', row.address)">{{ row.address ? row.address : 'Редагувати'}}</a>
            </td>
            <td data-title="'Facebook'" filter="{'facebook': 'text'}" sortable="'facebook'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'facebook', row.facebook)">{{ row.facebook ? row.facebook : 'Редагувати'}}</a>
            </td>
            <td data-title="'Освіта'" filter="{'education': 'text'}" sortable="'education'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'education', row.education)">{{ row.education ? row.education : 'Редагувати'}}</a>
            </td>
            <td data-title="'Сімейний стан, діти'" filter="{'family_status_children': 'text'}" sortable="'family_status_children'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'family_status_children', row.family_status_children)">{{ row.family_status_children ? row.family_status_children : 'Редагувати'}}</a>
            </td>
            <td data-title="'Звідки отримали інформацію про І.Т.А.'" filter="{'source_about_us': 'text'}" sortable="'source_about_us'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'source_about_us', row.source_about_us)">{{ row.source_about_us ? row.source_about_us : 'Редагувати'}}</a>
            </td>
            <td data-title="'Захоплення'" filter="{'interests': 'text'}" sortable="'interests'">
                <a ng-href="" ng-click="updateStudentInfo(row.id_student ,'interests', row.interests)">{{ row.interests ? row.interests : 'Редагувати'}}</a>
            </td>
        </tr>
    </table>
</div>