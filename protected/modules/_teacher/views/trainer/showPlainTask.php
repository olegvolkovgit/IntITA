<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 14.12.2015
 * Time: 14:43
 *
 * @var $plainTask PlainTaskAnswer
 * @var $mark PlainTaskMarks
 */
$mark = $plainTask->mark();
?>

<div class="col-md-8" >
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Оцінка простої задачі</h3>
    </div>
    <div class="panel-body">
            <input type="text" id="plainTaskId" hidden="hidden" value="<?php echo $plainTask->id; ?>">
            <input type="text" id="userId" hidden="hidden" value="<?php echo $plainTask->id_student; ?>">

            <div class="form-group">
                <label for="fromWho">Від кого</label>
                <input type="text" class="form-control" id="fromWho"
                       placeholder="<?php echo $plainTask->getStudentName() ?>" readonly>
            </div>
            <div class="form-group">
                <label for="condition">Задача</label>
                <textarea class="form-control" name="condition" id="textareaSettingsbyId"
                          readonly><?php echo $plainTask->getCondition() ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="answer">Відповідь</label>
                <textarea class="form-control" name="answer" id="textareaSettingsbyId"
                          readonly><?php echo $plainTask->answer; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="mark">Оцінка</label>
                <input type="number" max="1" min="0" id="mark" value="<?=$mark['mark'];?>">

            </div>
            <div class="form-group">
                <label for="comment">Коментар до задачі</label>
                <textarea class="form-control" name="comment" id="textareaSettingsbyId"><?=$mark['comment'];?></textarea>
            </div>
            <button onclick="markPlainTask('<?php echo Yii::app()->createUrl('/_teacher/teacher/markPlainTask') ?>')"
                    class="btn btn-primary"><?php echo ($mark['mark'])?'Змінити оцінку':'Оцінити';?>
            </button>

        </div>
    </div>
</div>
