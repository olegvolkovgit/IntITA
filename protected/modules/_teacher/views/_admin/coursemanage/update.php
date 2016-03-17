<?php
/* @var $this CoursemanageController *
 * @var $model Course
 * @var $levels array
 * @var $modules array
 */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'); ?>')">
            <?php echo Yii::t("coursemanage", "0510"); ?></button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/view',
                    array('id' => $model->course_ID)); ?>')">
            Переглянути курс
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="setCourseStatus('<?php echo Yii::app()->createUrl("/_teacher/_admin/coursemanage/changeStatus",
                    array("id" => $model->course_ID)); ?>', '<?= ($model->isActive()) ? 'Видалити курс?' : 'Відновити курс?'; ?>')">
            <?= ($model->isActive()) ? 'Видалити' : 'Відновити'; ?></button>
    </li>
    <li>
        <button type="button" class="btn btn-success"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/schema',
                    array('idCourse' => $model->course_ID)); ?>', 'Згенерувати схему курса')">
            Згенерувати схему курса
        </button>
    </li>
</ul>

<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#main" data-toggle="tab">Головне</a>
            </li>
            <li><a href="#ua" data-toggle="tab">Українською</a>
            </li>
            <li><a href="#ru" data-toggle="tab">Російською</a>
            </li>
            <li><a href="#en" data-toggle="tab">Англійською</a>
            </li>
            <li><a href="#modules" data-toggle="tab">Модулі</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <form class="form-horizontal" role="form" name="courseForm" id="courseForm"
              action="<?= Yii::app()->createUrl("/_teacher/_admin/coursemanage/newCourse") ?>">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="main">
                    <?php $this->renderPartial('_mainEditTab', array('model' => $model, 'levels' => $levels, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="ua">
                    <?php $this->renderPartial('_uaEditTab', array('model' => $model, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="ru">
                    <?php $this->renderPartial('_ruEditTab', array('model' => $model, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="en">
                    <?php $this->renderPartial('_enEditTab', array('model' => $model, 'scenario' => 'update')); ?>
                </div>
                <div class="tab-pane fade" id="modules">
                    <?php $this->renderPartial('_modulesTab', array(
                        'model' => $model,
                        'modules' => $modules,
                        'scenario' => 'update'
                    )); ?>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $jq(document).ready(function() {
        $jq.validator.setDefaults({
            ignore: ""
        });

        $jq(".tab-content").find("div.tab-pane").each(function (index, tab) {
            var id = $jq(tab).attr("id");
            $jq('a[href="#' + id + '"]').tab('show');

            var IsTabValid = $jq("#courseForm").valid();

            if (!IsTabValid) {
                IsValid = false;
            }
        });

        // Show first tab with error
        $jq(".tab-content").find("div.tab-pane").each(function (index, tab) {
            var id = $jq(tab).attr("id");
            $jq('a[href="#' + id + '"]').tab('show');

            var IsTabValid = $jq("#courseForm").valid();

            if (!IsTabValid) {
                return false;
            }
        });

        $jq("#courseForm").validate({
            ignore: ""
        });
    });
</script>

