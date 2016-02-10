<?php
/* @var $course Course*/
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>')">
            Список модулів</button>
    </li>
</ul>

<div class="page-header">
    <h4>Модуль #<?php echo $id . " " . Module::getModuleName($id); ?></h4>
</div>
<br>
<form onsubmit="addMandatory('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/addMandatoryModule'); ?>');return false;"
      name="add-accessModule">
    <fieldset>
        <div class="col-md-4">
            <legend id="label">Задати попередній модуль у курсі:</legend>
            <div class="form-group">
                Виберіть курс:<br>

                <input type="hidden" value="<?php echo $id; ?>" id="module">

                <select name="course" class="form-control" id="courseList"
                        onchange="selectModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/getModuleByCourse');?>')">
                    <option value="">Виберіть курс</option>
                    <optgroup label="Курси">
                        <?php
                        foreach ($courses as $course) {
                            ?>
                            <option value="<?php echo $course->course_ID;?>"><?php echo $course->getTitle();
                            $mandatory = $course->mandatoryModule($id);
                            if ($mandatory != 0) {
                                ?>
                                - попередній модуль
                                #<?php echo Module::getModuleName($mandatory); ?></option>
                            <?php
                            }
                        }
                        ?>
                </select>
            </div>
            <br>
            <br>

            <div class="form-group">
                Попередній модуль:<br>

                <div name="selectModule">
                    <?php $this->renderPartial('_ajaxModule', array('modules' => '')); ?>
                </div>
            </div>
            <br>
            <br>
            <br>
            <input class="btn btn-default" type="submit" value="Задати попередній модуль">

        </div>
        <br>
        <br>
</form>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ajaxModule.js'); ?>"></script>
