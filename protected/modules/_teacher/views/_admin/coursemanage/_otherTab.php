<?php
/**
 * @var $scenario string
 * @var $linkedCourses CourseLanguages
 * @var $model Course
 * @var $item string
 */
$langs = array_diff(array('ua', 'ru', 'en'), array($model->language));
?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php if ($scenario == "update") { ?>
            <ul class="list-inline">
            <?php foreach ($langs as $item) {
                $param = 'lang_' . $item;
                if ($linkedCourses->$param == null) {
                    ?>
                    <li>

                        <button type="button" class="btn btn-outline btn-primary" ng-click="changeView('addLinkedCourse/<?= $model->course_ID ?>/<?= $item ?>')">
                            Додати курс (<?= $item ?>)
                        </button>
                    </li>
                <?php } ?>
            <?php }?>
            </ul>
        <?php }?>

        <?php if ($linkedCourses) { ?>
            <div class="col-md-12">
                <div class="row">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="modulesListTable">
                            <thead>
                            <tr>
                                <th>Курс</th>
                                <th>Мова</th>
                                <?php if ($scenario == "update") { ?>
                                    <th width="15%">Видалити</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($langs as $item) {
                                if ($linkedCourses["lang_" . $item] != null) {
                                    $course = Course::model()->findByPk($linkedCourses["lang_" . $item]);
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?= Yii::app()->createUrl('course/index', array('id' => $linkedCourses["lang_" . $item])); ?>"
                                               target="_blank">
                                                <?= CHtml::encode($course->title_ua) . " (" . $course->language . ")"; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= $item; ?>
                                        </td>
                                        <?php if ($scenario == "update") { ?>
                                            <td>
                                                <a href="javascript:void(0)"  ng-click="deleteMod('<?=$linkedCourses->id?>', '<?=$item?>' )"
                                                  >видалити</a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "Пов'язаних курсів на інших мовах немає.";
        }
        ?>
    </div>
</div>

