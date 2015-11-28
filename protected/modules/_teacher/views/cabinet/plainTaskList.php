<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 27.11.2015
 * Time: 15:13
 */
?>
<ol>
    <?php foreach($plainTasks as $plainTask)
    {?>
        <li><a href="<?php echo Yii::app()->createUrl("_teacher/cabinet/showPlainTask", array("id" => $plainTask->id))?>">
                <?php echo substr($plainTask->getDescription(),0,25); ?></a></li>
    <?php }  ?>

</ol>