<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 14.12.2015
 * Time: 14:43
 * @var $plainTask PlainTaskAnswer
 */
?>

<div class="col-md-8" >
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Оцінка простої задачі</h3>
    </div>
    <div class="panel-body">
            <input type="text" id="plainTaskId" hidden="true" value="<?php echo $plainTask->id ?>">
            <input type="text" id="userId" hidden="true" value="<?php echo $plainTask->id_student ?>">
            <div class="form-group">
                <label for="fromWho">Від кого</label>
                <input type="text" class="form-control" id="fromWho" placeholder="<?php echo $plainTask->getStudentName() ?>" readonly>
            </div>
            <div class="form-group">
                <label for="condition">Задача</label>
                <textarea class="form-control" name="condition" id="textareaSettingsbyId" readonly><?php echo $plainTask->getCondition() ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="answer">Відповідь</label>
                <textarea class="form-control" name="answer" id="textareaSettingsbyId" readonly><?php echo $plainTask->answer ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="mark">Оцінка</label>
                <input type="number" max="1" min="0" id="mark">
            </div>
            <div class="form-group">
                <label for="comment">Коментар до задачі</label>
                <textarea class="form-control" name="comment" id="textareaSettingsbyId" ></textarea>
            </div>
            <button onclick="markPlainTask('<?php echo Yii::app()->createUrl('/_teacher/teacher/markPlainTask') ?>')"
                    class="btn btn-default">Оцінити</button>

    </div>
</div>
</div>
