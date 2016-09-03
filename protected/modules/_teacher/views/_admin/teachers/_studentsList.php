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
                <input type="number" hidden="hidden" id="student" value="0"/>
                <input id="typeahead" type="text" class="form-control" name="student" placeholder="Студент"
                       size="65" required autofocus>
            </div>
            <div class="col col-md-2">
                <button type="button" class="btn btn-success"
                        ng-click="addTeacherAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/setTeacherRoleAttribute'); ?>',
                            attribute.key, '#student')">
                    Додати студента
                </button>
            </div>
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
                <th>Відмінено</th>
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
                <td>{{student.end_date}}</td>
                <td>
                    <a ng-if="!student.end_date" href=""
                       ng-click="cancelModuleAttr('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/unsetTeacherRoleAttribute"); ?>',
                           student.id, attribute.key);">скасувати
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