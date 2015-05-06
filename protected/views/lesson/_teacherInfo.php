<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 09.04.2015
 * Time: 15:34
 */
$user = new StudentReg();
$app = Yii::app();
$teacher = Teacher::model()->findByPk($lecture->idTeacher);
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/bootstrap/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/bootstrap/css/bootstrap.css">
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css">

<div class="teacherBlock">
    <img src="<?php echo Yii::app()->request->baseUrl.'/css/images/teacherImage.png';//$teacher->foto_url; ?>">
    <a href="<?php echo Yii::app()->request->baseUrl.$teacher->readMoreLink; ?>"><?php echo Yii::t('teachers','0059'); ?> &#187;</a>
        <span>
                <ul>
                    <li> <div class="teacherTitle">
                            <?php echo Yii::t('lecture','0077'); ?></div>
                    </li>
                    <li>
                        <?php echo $teacher->last_name." ".$teacher->first_name." ".$teacher->middle_name;?>
                    </li>
                    <li>
                        <?php echo $teacher->email; ?>
                    </li>
                    <li>
                        <?php echo $teacher->tel; ?>
                    </li>
                    <li>
                        <?php echo 'skype: '?><div id="teacherSkype"><?php echo $teacher->skype; ?>
                        </div>
                    </li>
                    <!--Календарь консультацій з календарем, часом консультацій і інформаційною формою-->
                    <div class="calendar">
                        <!--Календарь-->
                        <div class="input-append date form_datetime" id="form_datetime">
                            <input size="16" type="text" value="" readonly id="dateTimePicker">
                            <span class="add-on"><i class="icon-th"></i></span>
                            <!--Скрита форма з Ajax кнопкою для передачі і виводу зайнятих інтервалів консультацій-->
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'ajaxchange-form',
                            )); ?>
                            <input type="hidden" id="dateconsajax" name="dateconsajax" />
                            <input type="hidden" name="teacherIdajax" value=<?php echo $teacher->teacher_id; ?> />
                            <?php
                            echo CHtml::ajaxSubmitButton('Updatedate', CController::createUrl('lesson/UpdateAjax'), array('update' => '#timeConsultation'), array('id' => 'hiddenAjaxButton'));
                            ?>
                            <?php $this->endWidget(); ?>
                        </div>
                        <!--Інтервали консультацій-->
                        <div id="timeConsultation">
                           <?php $this->renderPartial('_timeConsult', array('teacherId'=>$teacher->teacher_id,'day'=>'')); ?>
                        </div>
                        <!--Інформативна форма після вибору консультації-->
                        <div id="consultationInfo">
                            <form  action="<?php echo Yii::app()->createUrl('consultationscalendar/saveconsultation');?>" method="post">
                                <p class="consInfHeader">
                               Вітаємо!
                                </p>
                                <p id="consInfText">
                                    у Вас запланована консультація по темі <?php echo $lecture->title ?>, викладач <?php echo $teacher->last_name." ".$teacher->first_name." ".$teacher->middle_name;?>.
                                </p>
                                <input type="hidden" id="datecons" name="datecons" />
                                <input type="hidden" id="timecons" name="timecons" />
                                <input type="hidden"  name="teacherid" value="<?php echo $teacher->teacher_id; ?>" />
                                <input type="hidden"  name="userid" value="<?php echo Yii::app()->user->id; ?>" />
                                <input type="hidden"  name="lectureid" value="<?php echo $lecture->id; ?>" />
                                <input name="saveConsultation" id="consultationButton" type="submit" value="Добре">
                            </form>
                        </div>
                        <a id="consultationCalendar">
                            <?php echo Yii::t('lecture','0079'); ?>
                        </a>
                    </div>

                </ul>
        </span>
    </div>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ua.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ru.js"></script>


<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/parseTable.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/showCalendar.js"></script>

<script type="text/javascript">
    $('#dateTimePicker').datetimepicker({
        format: "yyyy-mm-dd",
        language: "<?php echo $app->session['lg']?>",
        weekStart: 1,
        todayBtn:  0,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        startDate: new Date()
    });
    $('#dateTimePicker').datetimepicker('setDaysOfWeekDisabled', [0,6]);
</script>


