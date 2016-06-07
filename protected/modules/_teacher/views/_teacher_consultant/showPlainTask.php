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

<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Оцінка простої задачі</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <input type="text" id="plainTaskId" hidden="hidden" value="<?php echo $plainTask->id; ?>">
                <input type="text" id="userId" hidden="hidden" value="<?php echo $plainTask->id_student; ?>">
            <div class="form-group col-md-10">
                <label for="fromWho">Від кого</label>
                <input type="text" class="form-control" id="fromWho"
                       placeholder="<?php echo $plainTask->getStudentName() ?>" readonly>
            </div>
            <div class="form-group col-md-10">
                <label for="condition">Умова задачі</label>
                <div class="form-control" name="condition" id="textareaSettingsbyId"
                          readonly><?php echo $plainTask->getCondition() ?>
                </div>
            </div>
            <div class="form-group col-md-10">
                <label for="answer">Відповідь</label>
                <textarea class="form-control" name="answer" id="textareaSettingsbyId"
                          readonly><?php echo $plainTask->answer; ?>
                </textarea>
            </div>
            <div class="form-group col-md-10">
                <label for="mark">Оцінка</label>
                <select class="form-control" id="mark">
                    <option value="0">не зараховано</option>
                    <option value="1" <?php if($mark['mark'] == "1") echo "selected";?>>зараховано</option>
                </select>
            </div>

            <div class="form-group col-md-10">
                <label for="comment">Коментар до задачі</label>
                <textarea class="form-control" name="comment" id="textareaSettingsbyId"><?=$mark['comment'];?></textarea>
            </div>
                <div class="col-md-3">
            <button onclick="markPlainTask('<?php echo Yii::app()->createUrl('/_teacher/_teacher_consultant/teacherConsultant/markPlainTask') ?>',
                '<?=Yii::app()->user->getId();?>')"
                    class="btn btn-primary"><?php echo ($mark['mark'])?'Змінити оцінку':'Оцінити';?>
            </button>
                </div>
        </div>
        </div>
    </div>
</div>