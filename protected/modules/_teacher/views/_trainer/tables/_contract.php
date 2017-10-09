<div ng-controller="contractStudentsCtrl">
    <table ng-table="studentContractInfoTableParams" class="table table-bordered table-striped table-condensed">
        <tr ng-repeat="row in $data track by $index">
            <td data-title="'Примітки'" filter="{'notes': 'text'}" sortable="'notes'">
                <a ng-href="" ng-click="updateContractInfo(row.id_student ,'notes', row.notes)">{{ row.notes ? row.notes : 'Редагувати' }}</a>
            </td>
            <td style="word-wrap:break-word" data-title="'Імя'" filter="{'first_name': 'text'}" sortable="'first_name'">
                <a ng-click="updateContractInfo(row.id_student ,'first_name', row.first_name)">{{ row.first_name ? row.first_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'По-батькові'" filter="{'middle_name': 'text'}" sortable="'middle_name'">
                <a ng-href="" ng-click="updateContractInfo(row.id_student ,'middle_name', row.middle_name)">{{ row.middle_name ? row.middle_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'Прізвище'" filter="{'second_name': 'text'}" sortable="'second_name'">
                <a ng-href="" ng-click="updateContractInfo(row.id_student ,'second_name', row.second_name)">{{ row.second_name ? row.second_name : 'Редагувати' }}</a>
            </td>
            <td data-title="'Номер договору'">
                ???
            </td>
            <td data-title="'Назва курсу'">
                ???
            </td>
            <td data-title="'Назва підгрупи'">
                ???
            </td>
            <td data-title="'Назва групи'">
                ???
            </td>
            <td data-title="'Дата заключення договору'">
                ???
            </td>
            <td data-title="'Дата початку навчання'">
                ???
            </td>
            <td data-title="'Дата завершення навчання'">
                ???
            </td>
            <td data-title="'Спосіб оплати за навчання'">
                ???
            </td>
            <td data-title="'Борг'">
                ???
            </td>
            <td data-title="'Коментар по боргу'" filter="{'debt_comment': 'text'}" sortable="'debt_comment'">
                <a ng-href="" ng-click="updateContractInfo(row.id_student ,'debt_comment', row.debt_comment)">{{ row.debt_comment ? row.debt_comment : 'Редагувати' }}</a>
            </td>
            <td data-title="'Дата розірвання договору'">
                ???
            </td>
        </tr>
    </table>
</div>