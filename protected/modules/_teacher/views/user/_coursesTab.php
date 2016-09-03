<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if(Yii::app()->user->model->isAdmin()){?>
        <div class="row">
            <form>
                <input type="number" hidden="hidden" ng-value=data.user.id id="user">
                <input type="text" hidden="hidden" value="student" id="role">
                <div class="col col-md-6">
                    <input type="number" hidden="hidden" id="value" value="0"/>
                    <input id="typeaheadCourse" type="text" class="form-control" name="course" placeholder="Назва курса"
                           size="65" required autofocus>
                </div>
                <div class="col col-md-2">
                    <button type="button" class="btn btn-success"
                            ng-click="addStudentAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/payCourse'); ?>',
                                data.user.id,
                                'course')">
                        Сплатити курс
                    </button>
                </div>
            </form>
        </div>
        <?php } ?>
        <br>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Проплачені курси:</h4>
                <ul ng-if="data.courses.length" class="list-group">
                    <li ng-repeat="course in data.courses track by $index" class="list-group-item">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="" data-toggle="collapse" ng-click="collapse('#collapse'+course.id)">
                                            {{course.title}} ({{course.lang}})
                                        </a>
                                        <?php if(Yii::app()->user->model->isAdmin()){?>
                                            <a type="button" class="btn btn-outline btn-success btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/agreement/course/{{course.id}}">
                                                <em>договір</em>
                                            </a>
                                            <a href=""
                                               ng-click="cancelCourse('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/cancelCourse'); ?>',course.id,data.user.id)">
                                                <span class="warningMessage"><em> скасувати доступ</em></span>
                                            </a>
                                        <?php } ?>
                                    </h4>
                                </div>
                                <div id="collapse{{course.id}}" class="panel-collapse collapse">
                                    <ul>
                                        <li ng-repeat="module in course.modules track by $index">
                                            <a href={{module.link}} target="_blank">
                                                {{module.title}} ({{module.lang}})
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <em ng-if="!data.courses.length">Курсів немає.</em>
            </div>
        </div>
    </div>
</div>
<script>
    var courses = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/pay/coursesByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (courses) {
                return $jq.map(courses.results, function (course) {
                    return {
                        id: course.id,
                        title: course.title
                    };
                });
            }
        }
    });

    courses.initialize();

    $jq('#typeaheadCourse').typeahead(null, {
        name: 'courses',
        display: 'title',
        limit: 10,
        source: courses,
        templates: {
            empty: [
                '<div class="empty-message">',
                'курсів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadCourse').on('typeahead:selected', function (e, item) {
        $jq("#value").val(item.id);
    });
</script>

