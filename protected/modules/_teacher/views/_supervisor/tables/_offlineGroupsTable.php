<a type="button" class="btn btn-primary" ng-href="#/supervisor/addOfflineGroup">
    Створити офлайн групу
</a>
<br>
<br>
<form autocomplete="off">
    <table ng-table="offlineGroupsTableParams" class="table table-bordered table-striped table-condensed">
        <tr ng-repeat="row in $data track by row.id">
            <td data-title="'Назва'" sortable="'name'" filter="{'name': 'text'}" >
                <a ng-href="#/supervisor/offlineGroup/{{row.id}}">{{row.name}}</a>
            </td>
            <td data-title="'Дата створення'" filter="{'start_date': 'text'}" sortable="'start_date'">{{row.start_date}}</td>
            <td data-title="'Спеціалізація'" filter="{'specializationName.title_ua': 'text'}" sortable="'specializationName.title_ua'">{{row.specializationName.title_ua}}</td>
            <td data-title="'Місто'" filter="{'cityName.title_ua': 'text'}" sortable="'cityName.title_ua'">{{row.cityName.title_ua}}</td>
            <td data-title="'Керівник чату групи'" filter="{'userChatAuthor.fullName': 'text'}" sortable="'userChatAuthor.fullName'">
                <a ng-href="#/supervisor/userProfile/{{row.chat_author_id}}">{{row.userChatAuthor.fullName}} ({{row.userChatAuthor.email}})</a>
            </td>
        </tr>
    </table>
</form>