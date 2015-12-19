<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 09.12.2015
 * Time: 16:54
 *
 * @var $plainTaskAnswer PlainTaskAnswer
 */
if(!empty($plainTasksAnswers))
{?>
<div class="col-md-9">
    <table class="table table-striped">
        <tr>
            <td>Номер задачі</td>
            <td>Студент</td>
            <td>Відповідь</td>
            <td>Який модуль</td>
            <td>Призначити тренера</td>
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
                    <a href="javascript:chooseTrainer('<?php echo $plainTaskAnswer->id ?>',
                    '<?php echo Yii::app()->createUrl('_teacher/teacher/addConsultant')?>')" target="_blank">
                     <img style="padding-left: 50px" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'add.png')?>"
                    </a>
                    </td>
            </tr>
            <?php } }  ?>
    </table>
</div>
<?php
}
else echo 'Наразі всі задачі з тренерами';?>


