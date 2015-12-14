<?php
/**
 * @var $plainTaskAnswer PlainTaskAnswer
 * @var $teacher Teacher
 */
?>

<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/consult.css'); ?>" rel="stylesheet">

<div class="col-md-6">

    <form role="form" method="post" id="assignedConsult" action="javascript:void(null)"

          onsubmit="sendForm('<?php echo Yii::app()->createUrl('_teacher/teacher/assignedConsultant')?>');" >
        <input type="text" name="id" id="idPlainTask" value="<?php echo $plainTaskAnswer->id ?>" hidden="true">

        <div class="form-group">
            <label for="student">Ім'я або email студента :</label>
            <input name="student" type="text" class="form-control"
                   placeholder="<?php echo $plainTaskAnswer->getStudentName(); ?>" disabled>
        </div>
        <div class="form-group">
            <label for="module">Назва модуля :</label>
            <input name="module" type="text" class="form-control"
                   placeholder="<?php echo $plainTaskAnswer->getModule()->title_ua; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="answer">Відповідь на задачу :</label>
            <textarea id="textAnswer" name="answer" class="form-control" disabled>
                <?php echo $plainTaskAnswer->answer; ?>
            </textarea>
        </div>
        <div class="form-group">
            <?php $teachers = $plainTaskAnswer->getTrainersByAnswer() ?>
            <label for="consult">Можливі консультанти :</label>

            <select name="consult" id="consult" class="form-control">
                <?php foreach ($teachers as $teacher) {?>
                    <option value="<?php echo $teacher->teacher_id?>"><?php echo $teacher->getName()?></option>
                <?php }?>

            </select>
        </div>
        <button type="submit" class="btn btn-default">Призначити консультанта</button>
    </form>


</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_teachers/newPlainTask.js'); ?>"></script>
