<?php
/* @var $attribute array
 * @var $user integer
 * @var $role string
 */
?>
<br>
<div class="col-md-12">
    <div class="row">
        <form>
            <div class="col col-md-6">
                <input type="text" size="135" ng-model="formData.userSelected"  ng-model-options="{ debounce: 1000 }"
                       placeholder="Студент" uib-typeahead="item.email for item in getStudents($viewValue) | limitTo : 10"
                       typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html"
                       typeahead-on-select="onSelectUser($item)" ng-change="reloadUser()" class="form-control" />
                <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> студента не знайдено
                </div>
            </div>
            <button type="button" class="btn btn-success"
                    ng-click="setTrainerRoleAttribute(data.user.role,attribute.key,data.user.id,selectedUser.id)">
                Додати студента
            </button>
            <a type="button" class="btn btn-default" ng-click='back()'>
                Назад
            </a>
        </form>
    </div>
    <br>
    <div>
        <b>Викладач: {{data.user.firstName}} {{data.user.secondName}} ({{data.user.email}})</b>
    </div>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="studentsListTable" datatable="ng" dt-options="dtStudentsOptions" dt-column-defs="dtColumnDefs">
            <thead>
            <tr>
                <th>Студент</th>
                <th>Призначено</th>
                <th>Видалити</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="student in attribute.value">
                <td>
                    {{student.title}}({{student.email}})
                    <a ng-href="/profile/{{student.id}}"
                       target="_blank">
                        (профіль)
                    </a>
                </td>
                <td>{{student.start_date}}</td>
                <td>
                    <a ng-if="!student.end_date" href=""
                       ng-click="cancelTrainerRoleAttribute(data.user.role, attribute.key, data.user.id, student.id);">скасувати
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/teachers/usersByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        url: user.url
                    };
                });
            }
        }
    });

    users.initialize();

    $jq('#typeahead').typeahead(null, {
        name: 'users',
        display: 'email',
        limit: 10,
        source: users,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає користувачів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#student").val(item.id);
    });
</script>