<?php
/**
 * @var $scenario string
 * @var $linkedCourses CourseLanguages
 * @var $model Course
 * @var $item string
 */
?>
<?php if ($linkedCourses){ ?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if ($scenario == "update") { ?>
            <ul class="list-inline">
                <li>
                    <button type="button" class="btn btn-outline btn-primary">
                        Додати курс на іншій мові
                    </button>
                </li>
            </ul>
        <?php } ?>

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
                        $langs = array_diff(array('ua', 'ru', 'en'), array('ua'));
                        foreach ($langs as $item) {
                            if ($linkedCourses["lang_" . $item] != 0 && $item != $model->language) {
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
                                            <a href="#" onclick="<? ?>">
                                                видалити</a>
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
    </div>
</div>
<?php
} else {
    echo "Пов'язаних курсів на інших мовах немає.";
}
?>
