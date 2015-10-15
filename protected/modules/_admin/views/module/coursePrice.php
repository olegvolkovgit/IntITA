<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/module/index');?>">Список модулів</a>
<br>
<h2>Модуль #<?php echo $id." ".ModuleHelper::getModuleName($id);?></h2>
<br>
<form action="<?php echo Yii::app()->createUrl('/_admin/module/addCoursePrice');?>" method="POST" name="add-accessModule">
    <fieldset>
        <legend id="label">Задати ціну модуля у курсі:</legend>
        Виберіть курс:<br>
        <input type="text" hidden="hidden" value="<?php echo $id;?>" name="module">
        <select name="course" id="courseList" required>
            <option value="">Виберіть курс</option>
            <optgroup label="Курси">
                <?php $courses = CourseHelper::generateModuleCoursesList($id);
                $count = count($courses);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];
                    if ($courses[$i]["price"] > 0) {
                        echo '  - поточна ціна '.$courses[$i]["price"].'$'; ?></option>
                    <?php
                    }
                }
                ?>
        </select>
        <br>
        <br>
        <label for="price">Нова ціна: </label>
        <input type="number" name="price" required/>
        <br>
        <br>
        <input type="submit" value="Зберегти ціну модуля">
</form>
