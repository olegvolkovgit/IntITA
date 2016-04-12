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
                <div>
                    <?php if ($model->langUa) { ?>
                        <a href="<?= Yii::app()->createUrl("course/index", array('id' => $model->langUa->course_ID)); ?>"
                           target="_blank">
                            <?= $model->langUa->getTitle() . " (" . $model->langUa->language . ")"; ?>
                        </a>
                    <?php } else {
                        if ($course->language == "ua") {
                            ?>
                            <a href="<?= Yii::app()->createUrl("course/index", array('id' => $course->course_ID)); ?>">
                                <?= $course->getTitle() . " (" . $course->language . ")"; ?>
                            </a>
                        <?php } else {
                            echo "не задано";
                        }
                    } ?>
                </div>
                <?php if ($course->language != 'ua') { ?>
                    <input type="number" hidden="hidden" id="uaCourse" value="<?=($model->langUa)?$model->lang_ua:'0'?>"/>
                    <input id="typeaheadUaCourse" type="text" size="135" class="form-control" placeholder="змінити">
                    <br>
                <?php } else { ?>
                    <input type="number" hidden="hidden" id="uaCourse" value="<?=$course->course_ID?>"/>
                <?php }?>
            </div>

            <div class="form-group">
                <label>Російською: </label>
                <div>
                    <?php if ($model->langRu) { ?>
                        <a href="<?= Yii::app()->createUrl("course/index", array('id' => $model->langRu->course_ID)); ?>"
                           target="_blank">
                            <?= $model->langRu->getTitle() . " (" . $model->langRu->language . ")"; ?></a>
                    <?php } else {
                        if ($course->language == "ru") {
                            ?>
                            <a href="<?= Yii::app()->createUrl("course/index", array('id' => $course->course_ID)); ?>">
                                <?= $course->getTitle() . " (" . $course->language . ")"; ?>
                            </a>
                        <?php } else {
                            echo "не задано";
                        }
                    } ?>
                </div>
                <?php if ($course->language != 'ru') { ?>
                    <input type="number" hidden="hidden" id="ruCourse" value="<?=($model->langRu)?$model->lang_ru:'0'?>"/>
                    <input id="typeaheadRuCourse" type="text" size="135" class="form-control" placeholder="змінити">
                    <br>
                <?php } else { ?>
                    <input type="number" hidden="hidden" id="ruCourse" value="<?=$course->course_ID?>"/>
                <?php }?>
            </div>

            <div class="form-group">
                <label>Англійською: </label>
                <div>
                    <?php if ($model->langEn) { ?>
                        <a href="<?= Yii::app()->createUrl("course/index", array('id' => $model->langEn->course_ID)); ?>"
                           target="_blank">
                            <?= $model->langEn->getTitle() . " (" . $model->langEn->language . ")"; ?></a>
                    <?php } else {
                        if ($course->language == "en") {
                            ?>
                            <a href="<?= Yii::app()->createUrl("course/index", array('id' => $course->course_ID)); ?>">
                                <?= $course->getTitle() . " (" . $course->language . ")"; ?>
                            </a>
                        <?php } else {
                            echo "не задано";
                        }
                    } ?>
                </div>
                <?php if ($course->language != 'en') { ?>
                    <input type="number" hidden="hidden" id="enCourse" value="<?=($model->langEn)?$model->lang_en:'0'?>"/>
                    <input id="typeaheadEnCourse" type="text" size="135" class="form-control" placeholder="змінити">
                    <br>
                <?php } else { ?>
                    <input type="number" hidden="hidden" id="enCourse" value="<?=$course->course_ID?>"/>
                <?php }?>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Редагувати"
                       onclick="addLinkedCourses('<?=Yii::app()->createUrl("/_teacher/_admin/coursemanage/changeLinkedCourses");?>'
                           ,'<?=($model->getIsNewRecord())?0:$model->id;?>',
                           '<?=$course->course_ID?>',
                           '<?="Курс ".$course->getTitle()?>'
                           )">
            </div>
        </fieldset>
    </form>
</div>
<script>
    initUaCourses();
    initRuCourses();
    initEnCourses();
</script>

