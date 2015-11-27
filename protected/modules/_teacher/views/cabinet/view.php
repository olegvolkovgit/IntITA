
<div class="teacherCabinet">
    <h3><a href=<?php echo Yii::app()->createUrl('/_teacher/cabinet/module',array('id' => $model->teacher_id));?>>Модулі</a></h3>

    <h3><a href=<?php echo Yii::app()->createUrl('/_teacher/cabinet/myPlainTask',array('id' => $model->teacher_id));?>>
            Переглянути список задач по модулю</a></h3>
</div>
