<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 09.12.2015
 * Time: 16:54
 */
if($plainTasksAnswers)
{?>
<div class="col-md-9">
    <table class="table table-striped">
        <tr>
            <td>Номер задачі</td>
            <td>Студент</td>
            <td>Відповідь</td>
            <td>Який модуль</td>
            <td>Призначити тренера</td>
<!--            <td>Можливі консультанти</td>-->
        </tr>
        <?php foreach($plainTasksAnswers as $plainTaskAnswer){
            $module = $plainTaskAnswer->getModule();
            if($module){?>
                <tr>
                    <td><?php echo $plainTaskAnswer->id;?></td>
                    <td><?php echo $plainTaskAnswer->getStudentName(); ?></td>
                    <td><?php echo substr($plainTaskAnswer->answer,0,25).'...';  ?></td>
                    <td><?php echo $module->title_ua ?></td>
                    <td>
                    <a href="<?php echo Yii::app()->createUrl('_teacher/cabinet/assignedConsultant',array('id' => $plainTaskAnswer->id));?>">
                    <img style="padding-left: 50px" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'add.png')?>"
                    </a>
                    </td>
<!--                    --><?php //$teachers = $plainTaskAnswer->getTrainersByAnswer() ?>
<!--                    <select class="form-control">-->
<!--                        --><?php //foreach ($teachers as $teacher) {?>
<!--                            <option value="--><?php //echo $teacher->teacher_id?><!--">--><?php //echo $teacher->getName()?><!--</option>-->
<!--                       --><?php //}?>
<!--                    </select>-->
            </tr>


            <?php } }  ?>

    </table>
</div>
<?php
}
else echo 'Наразі всі задачі з тренерами';?>