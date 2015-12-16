<br>
<button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/index'); ?>">Список модулів</a>
</button>
<br>
<div class="page-header">
    <h2>Модуль #<?php echo $id . " " . Module::getModuleName($id); ?></h2>
</div>
<br>
<form action="<?php echo Yii::app()->createUrl('/_admin/module/addMandatoryModule'); ?>" method="POST"
      name="add-accessModule">
    <fieldset>
        <div class="col-md-4">
            <legend id="label">Задати попередній модуль у курсі:</legend>
            <div class="form-group">
                Виберіть курс:<br>
                <input type="hidden" value="<?php echo $id; ?>" name="module">
                <select name="course" class="form-control" id="courseList" onchange="selectModule()">
                    <option value="">Виберіть курс</option>
                    <optgroup label="Курси">
                        <?php $courses = Course::generateModuleCoursesList($id);
                        $count = count($courses);
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];
                            if ($courses[$i]["mandatory"] != 0) {
                                ?>
                                - попередній модуль
                                #<?php echo Module::getModuleName($courses[$i]["mandatory"]); ?></option>
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

                <div name="selectModule" style="float:left;">
                    <?php $this->renderPartial('_ajaxModule', array('modules' => '')); ?>
                </div>
            </div>
            <br>
            <br>
            <input class="btn btn-default" type="submit" value="Задати попередній модуль">

        </div>
        <br>
        <br>
</form>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ajaxModule.js'); ?>"></script>
