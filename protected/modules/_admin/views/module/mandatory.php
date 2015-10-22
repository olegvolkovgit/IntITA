<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/module/index');?>">Список модулів</a>
<br>
<h2>Модуль #<?php echo $id." ".ModuleHelper::getModuleName($id);?></h2>
<br>
<form action="<?php echo Yii::app()->createUrl('/_admin/module/addMandatoryModule');?>" method="POST" name="add-accessModule">
    <fieldset>
        <legend id="label">Задати попередній модуль у курсі:</legend>
        Виберіть курс:<br>
        <input type="hidden" value="<?php echo $id;?>" name="module">
        <select name="course" id="courseList" onchange="selectModule()">
            <option value="">Виберіть курс</option>
            <optgroup label="Курси">
                <?php $courses = CourseHelper::generateModuleCoursesList($id);
                $count = count($courses);
                for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];
                    if ($courses[$i]["mandatory"] != 0) {
                            ?>
                            - попередній модуль
                            #<?php echo ModuleHelper::getModuleName($courses[$i]["mandatory"]); ?></option>
                    <?php
                    }
                }
                ?>
        </select>
        <br>
        <br>

        Попередній модуль:<br>
        <div name="selectModule" style="float:left;">
            <?php $this->renderPartial('_ajaxModule', array('modules'=>'')); ?>
        </div>

        <br>
        <br>

        <input type="submit" value="Задати попередній модуль">
</form>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?117"></script>

<!-- VK Widget -->
<div id="vk_groups"></div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ajaxModule.js'); ?>"></script>
