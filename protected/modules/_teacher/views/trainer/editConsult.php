<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 19.12.2015
 * Time: 12:12
 */
?>
<div class="col-md-6">

    <form role="form" method="post" id="assignedConsult"
          ng-submit='ediConsult("<?php echo Yii::app()->createUrl('_teacher/teacher/editConsultant')?>");' >

        <input type="text" name="id" id="idPlainTask" ng-value="<?php echo $task->id ?>" hidden="true">

        <div class="form-group">
            <label for="student">Ім'я або email студента :</label>
            <input name="student" type="text" class="form-control"
                   placeholder="<?php echo $task->getStudentName(); ?>" disabled>
        </div>
        <div class="form-group">
            <label for="module">Назва модуля :</label>
            <input name="module" type="text" class="form-control"
                   placeholder="<?php echo $task->getModule()->title_ua; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="answer">Відповідь на задачу :</label>
            <textarea id="textAnswer" name="answer" class="form-control" disabled>
                <?php echo $task->answer; ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="cons">Теперішній консультант :</label>
            <input name="cons" type="text" class="form-control"
                   placeholder="<?php echo $task->getConsultant()->getName(); ?>" disabled>
        </div>
        <div class="form-group">
            <?php $teachers = $task->getTrainersByAnswer() ?>
            <label for="consult">Можливі консультанти :</label>
            <select name="consult" id="consult" class="form-control">
                <?php foreach ($teachers as $teacher) {?>
                    <option value="<?php echo $teacher->teacher_id?>"><?php echo $teacher->getName()?></option>
                <?php }?>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Редагувати консультанта</button>
    </form>
</div>