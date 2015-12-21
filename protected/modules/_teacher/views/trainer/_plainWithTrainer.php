<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 19.12.2015
 * Time: 10:41
 * @var $tasks PlainTaskAnswer
 */
?>
<div class="col-md-9">

<?php if(!empty($tasks)){?>

        <table class="table table-striped">
            <tr>
                <td>Номер задачі</td>
                <td>Студент</td>
                <td>Відповідь</td>
                <td>Який модуль</td>
                <td>Консультант</td>
                <td>Управління консультантом</td>
            </tr>
    <?php foreach($tasks as $task)
    {
        $module = $task->getModule();

            if($module){?>
            <tr>
                <td><?php echo $task->id;?></td>
                <td><?php echo $task->getStudentName(); ?></td>
                <td><?php echo $task->getShortDescription();  ?></td>
                <td><?php echo $module->title_ua ?></td>
                <td><?php echo $task->getConsultant()->getName() ?></td>
                <td>
                    <a href="#" ng-click = 'changeConsult("<?php echo $task->id ?>",
                    "<?php echo Yii::app()->createUrl('_teacher/teacher/changeConsultant')?>")'>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'restore.png')?>"
                    </a>
                    <a href="#" ng-click = 'removeConsult("<?php echo $task->id ?>",
                    "<?php echo Yii::app()->createUrl('_teacher/teacher/deleteConsultant')?>")'>
                        <img  src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png')?>"
                    </a>
                </td>
            </tr>
   <?php }
    }

}
else echo 'Немає задач з тренерами';
?>
</div>
<hr>
