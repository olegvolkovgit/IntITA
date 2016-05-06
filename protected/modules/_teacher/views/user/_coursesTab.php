<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 */
$user = $model->registrationData;
$courses = $model->getAttributesByRole(UserRoles::STUDENT)[1]["value"];
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <form>
                <input type="number" hidden="hidden" value="<?= $user->id; ?>" id="user">
                <input type="text" hidden="hidden" value="student" id="role">
                <div class="col col-md-6">
                    <input type="number" hidden="hidden" id="value" value="0"/>
                    <input id="typeaheadCourse" type="text" class="form-control" name="course" placeholder="Назва курса"
                           size="65" required autofocus>
                </div>
                <div class="col col-md-2">
                    <button type="button" class="btn btn-success"
                            onclick="addStudentAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/pay/payCourse'); ?>',
                                '<?= $user->id; ?>',
                                '<?=addslashes($user->userName())." <".$user->email.">";?>',
                                'course')">
                        Сплатити курс
                    </button>
                </div>
            </form>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Проплачені курси:</h4>
                <?php if (!empty($courses)) { ?>
                    <ul class="list-group">
                        <?php foreach ($courses as $course) {
                            ?>
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#collapse<?= $course["id"] ?>">
                                                <?= $course["title"] . " (" . $course["lang"] . ")"; ?>
                                            </a>
                                            <button type="button" class="btn btn-outline btn-success btn-xs"
                                                    onclick="load('<?= Yii::app()->createUrl("/_teacher/user/agreement",
                                                        array("user" => $user->id, "param" => $course["id"], "type" => "course")) ?>')">
                                                <em>договір</em>
                                            </button>
                                        </h4>
                                    </div>
                                    <div id="collapse<?= $course["id"] ?>" class="panel-collapse collapse">
                                        <ul>
                                            <?php
                                            $courseModules = CourseModules::modulesWithStudentTeacher($course["id"], $user->id);
                                            foreach ($courseModules as $record) { ?>
                                                <li class="list-group-item">
                                                    <a href="<?= Yii::app()->createUrl("course/index", array("id" => $course["id"])); ?>"
                                                       target="_blank">
                                                        <?= $record["title"] . " (" . $record["lang"] . ")  "; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <em>Курсів немає.</em>
                <?php } ?>
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

