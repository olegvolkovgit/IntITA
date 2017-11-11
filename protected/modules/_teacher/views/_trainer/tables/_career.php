<div  ng-controller="careerStudentsCtrl">
    <table ng-table="studentCareerInfoTableParams" class="table table-bordered table-striped table-condensed" style="margin-right: 20px; table-layout: inherit;">
        <tr ng-repeat="row in $data track by $index">
            <td data-title="'Примітки'" filter="{'notes': 'text'}" sortable="'notes'">
                <a href="" ng-click="updateCareerInfo(row.id_student, 'notes', row.notes)">{{ row.notes ? row.notes : "Редагувати" }}</a>
            </td>
            <td style="word-wrap:break-word" data-title="'Імя'" filter="{'first_name': 'text'}" sortable="'first_name'">
                <a ng-href="" ng-click="updateCareerInfo(row.id_student ,'first_name', row.first_name)">{{ row.first_name ? row.first_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'По-батькові'" filter="{'middle_name': 'text'}" sortable="'middle_name'">
                <a ng-href="" ng-click="updateCareerInfo(row.id_student ,'middle_name', row.middle_name)">{{ row.middle_name ? row.middle_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'Прізвище'" filter="{'second_name': 'text'}" sortable="'second_name'">
                <a ng-href="" ng-click="updateCareerInfo(row.id_student ,'second_name', row.second_name)">{{ row.second_name ? row.second_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'Еmail'" filter="{'email': 'text'}">
                {{ row.email }}
            </td>
            <td data-title="'Місце роботи'" filter="{'current_job': 'text'}" sortable="'current_job'">
                <a ng-href="" ng-click="updateCareerInfo(row.id_student ,'current_job', row.current_job)">{{ row.current_job ? row.current_job : 'Редагувати' }}</a>
            </td>
            <td data-title="'Попереднє місце роботи'" filter="{'prev_job': 'text'}" sortable="'prev_job'">
                <a ng-href="" ng-click="updateCareerInfo(row.id_student ,'prev_job', row.prev_job)">{{ row.prev_job ? row.prev_job : 'Редагувати' }}</a>
            </td>
            <td data-title="'Освіта'" filter="{'education': 'text'}" sortable="'education'">
                <a ng-href="" ng-click="updateCareerInfo(row.id_student ,'education', row.education)">{{row.education ? row.education : 'Редагувати' }}</a>
            </td>
            <td data-title="'Рівень англійської мови'" filter="{'english_level': 'text'}" sortable="'english_level'">
                <a ng-href="" ng-click="updateCareerInfo(row.id_student ,'english_level', row.english_level)">
                    {{ row.english_level ? row.english_level : 'Редагувати' }}
                </a>
            </td>
            <td data-title="'Резюме на robota molodi'">
                ???
            </td>
            <td data-title="'Спеціалізації'" filter="{'specializations.id': 'select'}" filter-data="studentsSpecializations">
                <a href="" ng-if="!isEmpty(row.specializations)" ng-click="selectSpecialization(row.id, row.id_student)">
                    <span ng-repeat="item in row.specializations">{{ item.title_ua + ' ' }}</span>
                </a>
                <a href="" ng-if="isEmpty(row.specializations)"
                                ng-click="selectSpecialization(row.id, row.id_student, isEmpty(row.specializations))">
                    Редагувати
                </a>
            </td>
            <td data-title="'Бажана форма навчання'" filter="{ 'studyForm.id' : 'select' }" filter-data="educationForm">
                <a href="" ng-click="studyOption(row.studyForm.id, row.id_student)">
                    {{ row.studyForm.title_ua ? row.studyForm.title_ua : 'Редагувати'}}
                </a>
            </td>
            <td data-title="'Бажана зміна'" filter="{ 'studyTime.id': 'select' }" filter-data="educationTime">
                <a href="" ng-click="studyTime(row.studyTime.id, row.id_student)">
                    {{ row.studyTime.title_ua ? row.studyTime.title_ua : 'Редагувати' }}
                </a>
            </td>
            <td data-title="'Бажана форма проплати'" filter="{ 'payForm.pay_count' : 'select' }" filter-data="payForm">
                <a href="" ng-click="changePayForm(row.id_student, row.payForm.pay_count)">{{ row.payForm.title_ua ? row.payForm.title_ua : 'Редагувати' }}</a>
            </td>
            <td data-title="'Місце роботи після закінчення академії'">
                {{ row.graduate.work_place }}
            </td>
            <td data-title="'Відгук про навчання'">
                {{ row.graduate.recall }}
            </td>
        </tr>
    </table>
</div>