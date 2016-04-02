<?php
/**
 * @var $model CourseLanguages
 * @var $course Course
 */
?>
<div class="col-md-6">
    <form role="form">
        <fieldset>
            <div class="form-group">
                <label>Українською: </label>
                <?php if ($model->langUa) { ?>
                    <a href="<?= Yii::app()->createUrl("course/index", array('id' => $model->langUa->course_ID)); ?>" target="_blank">
                        <?= $model->langUa->getTitle()." (".$model->langUa->language.")"; ?>
                    </a>
                <?php } else {
                    if($course->language == "ua"){?>
                        <a href="<?= Yii::app()->createUrl("course/index", array('id' => $course->course_ID)); ?>">
                            <?= $course->getTitle()." (".$course->language.")"; ?>
                        </a>
                    <?php }
                    else {
                        echo "не задано";
                    }
                } ?>
                <?php if($course->language != 'ua'){?>
                    <input type="number" hidden="hidden" id="moduleId" value="0"/>
                    <input id="typeaheadUaCourse" type="text" class="form-control" placeholder="змінити">
                    <br>
                <?php }?>
            </div>

            <div class="form-group">
                <label>Російською: </label>
                <?php if ($model->langRu) { ?>
                    <a href="<?= Yii::app()->createUrl("course/index", array('id' => $model->langRu->course_ID)); ?>" target="_blank">
                        <?= $model->langRu->getTitle()." (".$model->langRu->language.")"; ?></a>
                <?php } else {
                    if($course->language == "ru"){?>
                        <a href="<?= Yii::app()->createUrl("course/index", array('id' => $course->course_ID)); ?>">
                            <?= $course->getTitle()." (".$course->language.")"; ?>
                        </a>
                    <?php }
                    else {
                        echo "не задано";
                    }
                }?>
                <?php if($course->language != 'ru'){?>
                    <input type="number" hidden="hidden" id="moduleId" value="0"/>
                    <input id="typeaheadRuCourse" type="text" class="form-control" placeholder="змінити">
                    <br>
                <?php }?>
            </div>

            <div class="form-group">
                <label>Англійською: </label>
                <?php if($model->langEn) { ?>
                    <a href="<?= Yii::app()->createUrl("course/index", array('id' => $model->langEn->course_ID)); ?>" target="_blank">
                        <?= $model->langEn->getTitle()." (".$model->langEn->language.")"; ?></a>
                <?php } else {
                    if($course->language == "en"){?>
                        <a href="<?= Yii::app()->createUrl("course/index", array('id' => $course->course_ID)); ?>">
                            <?= $course->getTitle()." (".$course->language.")"; ?>
                        </a>
                    <?php }
                    else {
                        echo "не задано";
                    }
                } ?>
                <?php if($course->language != 'en'){?>
                    <input type="number" hidden="hidden" id="moduleId" value="0"/>
                    <input id="typeaheadEnCourse" type="text" class="form-control" placeholder="змінити">
                    <br>
                <?php }?>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Редагувати" onclick="">
            </div>
        </fieldset>
    </form>
</div>
<script>
    initUaCourses();
    initRuCourses();
    initEnCourses();
//    var uaCourses = new Bloodhound({
//        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
//        queryTokenizer: Bloodhound.tokenizers.whitespace,
//        remote: {
//            url: basePath + '/_teacher/_admin/coursemanage/modulesByQuery?query=%QUERY',
//            wildcard: '%QUERY',
//            filter: function (courses) {
//                return $jq.map(courses.results, function (course) {
//                    return {
//                        id: course.id,
//                        title: course.title
//                    };
//                });
//            }
//        }
//    });
//
//    uaCourses.initialize();
//
//    $jq('#typeaheadModule').typeahead(null, {
//        name: 'modules',
//        display: 'title',
//        limit: 10,
//        source: modules,
//        templates: {
//            empty: [
//                '<div class="empty-message">',
//                'модулів з такою назвою немає',
//                '</div>'
//            ].join('\n'),
//            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
//        }
//    });
//
//    $jq('#typeaheadModule').on('typeahead:selected', function (e, item) {
//        $jq("#moduleId").val(item.id);
//    });
//
//
//    function addExistModule(url, course, title) {
//        module = $jq("#moduleId").val();
//        if (module == 0) {
//            bootbox.alert('Виберіть модуль.');
//        } else {
//            var posting = $jq.post(url, {
//                moduleId: module,
//                courseId:course
//            });
//
//            posting.done(function (response) {
//                    if (response == "success")
//                        bootbox.alert("Модуль успішно додано.", function () {
//                            load(basePath + '/_teacher/_admin/coursemanage/view/id/'+course,'Курс '+title,'','4');
//                        });
//                    else {
//                        bootbox.alert("Операцію не вдалося виконати");
//                    }
//                })
//                .fail(function () {
//                    bootbox.alert("Операцію не вдалося виконати");
//                });
//        }
//    }
</script>

