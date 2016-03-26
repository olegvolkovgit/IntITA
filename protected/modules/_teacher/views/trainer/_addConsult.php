<?php
/**
 * @var $plainTaskAnswer PlainTaskAnswer
 * @var $teacher Teacher
 * @var $teachers array
 */
?>

<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/consult.css'); ?>" rel="stylesheet">

<div class="col-md-12">

    <form role="form" method="post" id="assignedConsult">
        <input type="text" name="id" id="idPlainTask" value="<?php echo $plainTaskAnswer->id ?>" hidden="hidden">

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
            <?php
            if(empty($teachers)){?>
                <label>Консультантів з питань цього модуля ще не призначено.</label>
                <br>
                <br>
                <button type="submit" class="btn btn-success"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index')?>', 'Викладачі'); return false;">
                    Призначити консультанта для модуля</button>
            <?php } else {?>
            <label for="consult">Можливі консультанти :</label>

            <select name="consult" id="consult" class="form-control">
                <?php foreach ($teachers as $teacher) {?>
                    <option value="<?php echo $teacher->user_id?>"><?php echo $teacher->getName()?></option>
                <?php }?>
            </select>
        </div>
        <button type="submit" class="btn btn-success"
                onclick="sendForm('<?php echo Yii::app()->createUrl('/_teacher/teacher/assignedConsultant')?>'); return false;"
        >Призначити консультанта</button>
        <?php }?>
    </form>


</div>


