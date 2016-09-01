<br>
<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <form role="form">
            <div class="form-group">
                <input type="text" hidden="hidden" value="author" id="role">
                <label>Викладач:</label>
                <br>

                <div class="form-group">
                    <input type="text" size="135" ng-model="teacherSelected"  ng-model-options="{ debounce: 1000 }" placeholder="Викладач" uib-typeahead="item.email for item in getTeachers($viewValue) | limitTo : 10" typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html" typeahead-on-select="onSelect($item)" class="form-control" />
                    <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
                    <div ng-show="noResults">
                        <i class="glyphicon glyphicon-remove"></i> Викладача не знайдено
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>
                    <strong>Модуль:</strong>
                </label>
                <input type="text" size="135" ng-model="moduleSelected" ng-model-options="{ debounce: 1000 }" placeholder="Модуль" uib-typeahead="item.title for item in getModules($viewValue) | limitTo:10" typeahead-no-results="moduleNoResults" typeahead-on-select="selectModule($item)" class="form-control" />
                <i ng-show="loadingModules" class="glyphicon glyphicon-refresh"></i>
                <div ng-show="moduleNoResults">
                    <i class="glyphicon glyphicon-remove"></i> Модуль не знайдено
                </div>

            </div>
            <br>
            <div class="form-group">
                <button type="button" class="btn btn-success" ng-click="addPermission('moduleAuchtor')">Призначити автора модуля</button>
            </div>
        </form>
    </div>
    <script type="text/ng-template" id="customTemplate.html">
        <a>
            <div class="typeahead_wrapper  tt-selectable">
                <img class="typeahead_photo" ng-src="{{match.model.url}}" width="36">
                <div class="typeahead_labels">
                    <div ng-bind="match.model.name" class="typeahead_primary"></div>
                    <div ng-bind="match.model.email" class="typeahead_secondary"></div>
                </div>
            </div>


        </a>
    </script>
</div>

<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/permissions/teachersByQuery?query=%QUERY',
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

    var modules = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/permissions/modulesByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (modules) {
                return $jq.map(modules.results, function (module) {
                    return {
                        id: module.id,
                        title: module.title
                    };
                });
            }
        }
    });

    users.initialize();
    modules.initialize();

    $jq('#typeahead').typeahead(null, {
        name: 'users',
        display: 'email',
        limit: 10,
        source: users,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає викладачів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });

    $jq('#typeaheadModule').typeahead(null, {
        name: 'modules',
        display: 'title',
        limit: 10,
        source: modules,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadModule').on('typeahead:selected', function (e, item) {
        $jq("#moduleId").val(item.id);
    });

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#user").val(item.id);
    });
</script>