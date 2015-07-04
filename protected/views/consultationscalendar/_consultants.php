<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 15.06.2015
 * Time: 13:50
 */
?>
<div class="teacherBlock">
    <div class="leftBlock">
        <div style=" background: url(<?php echo StaticFilesHelper::createPath('image', 'teachers', $data['foto_url']); ?>) no-repeat; background-size: 90px;">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/common/img.png">
        </div>
        <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $data['teacher_id']))?>"><?php echo Yii::t('teachers','0059'); ?>&#187;</a>
    </div>
    <div class="rightBlock">
        <ul>
            <li>
                <div class="teacherTitle">
                    <?php echo 'Консультант' ?>
                </div>
            </li>
            <li>
                <?php echo $data['last_name']." ".$data['first_name']." ".$data['middle_name'];?>
            </li>
            <li>
                <?php echo $data['email']; ?>
            </li>
            <li>
                <?php echo $data['tel']; ?>
            </li>
            <li>
                <?php echo 'skype: '?>
                <span class="teacherSkype"><?php echo $data['skype']?></span>
            </li>
            <!--Календарь консультацій з календарем, часом консультацій і інформаційною формою-->
            <?php if(AccessHelper::canAddConsultation()){
                ?>
                <div class="calendar">
                    <!--            Календарь-->
                    <div class="input-append date form_datetime" id="form_datetime">
                        <input size="16" type="text" value="" onchange="showTime('<?php echo $data['teacher_id']; ?>')" readonly id="<?php echo 'dateTimePicker'.$data['teacher_id']?>">
                        <span class="add-on"><i class="icon-th"></i></span>
                        <!--Скрита форма з Ajax кнопкою для передачі і виводу зайнятих інтервалів консультацій-->
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'ajaxchange-form',
                        )); ?>
                        <input type="hidden" id="<?php echo 'dateconsajax'.$data['teacher_id']?>" name="dateconsajax" />
                        <input type="hidden" name="teacherIdajax" value=<?php echo $data['teacher_id']; ?> />
                        <?php
                        echo CHtml::ajaxSubmitButton('Updatedate', CController::createUrl('lesson/UpdateAjax'), array('update' => '#timeConsultation'.$data['teacher_id']), array('id' => 'hiddenAjaxButton'.$data['teacher_id']));
                        ?>
                        <?php $this->endWidget(); ?>
                    </div>
                    <!--Інтервали консультацій-->
                    <div class="timeBlock">
                        <div id="<?php echo 'timeConsultation'.$data['teacher_id']?>">
                            <?php $this->renderPartial('/lesson/_timeConsult', array('teacherId'=>$data['teacher_id'],'day'=>'')); ?>
                        </div>
                    </div>
                    <!--Інформативна форма після вибору консультації-->
                    <div class="consinf">
                        <div id="<?php echo 'consultationInfo'.$data['teacher_id']?>">
                            <form  action="<?php echo Yii::app()->createUrl('consultationscalendar/saveconsultation',array('idCourse'=>$idCourse));?>" method="post">
                                <p class="consInfHeader">
                                    Вітаємо!
                                </p>
                                <input type="hidden" class='consInfText' id="<?php echo 'consInfText'.$data['teacher_id']?>" value=" у Вас буде запланована консультація по темі <?php echo $lecture->title ?>, викладач <?php echo $data['last_name']." ".$data['first_name']." ".$data['middle_name'];?>. Для підтвердження натисніть 'Добре'." />
                                <p class='consInfText' id="<?php echo 'constext'.$data['teacher_id']?>"></p>
                                <input type="hidden" id="<?php echo 'datecons'.$data['teacher_id']?>" name="datecons" />
                                <input type="hidden" id="<?php echo 'timecons'.$data['teacher_id']?>" name="timecons" />
                                <input type="hidden"  name="teacherid" value="<?php echo $data['teacher_id']; ?>" />
                                <input type="hidden"  name="userid" value="<?php echo Yii::app()->user->id; ?>" />
                                <input type="hidden"  name="lectureid" value="<?php echo $lecture->id; ?>" />
                                <input name="saveConsultation" id="consultationButton" type="submit" value="Добре">
                            </form>
                            <button id="cancelButton" onclick="exit()" >Скасувати</button>
                        </div>
                    </div>
                    <a id="consultationCalendar" onclick="showCalendar('<?php echo $data['teacher_id']; ?>')">
                        <?php echo Yii::t('lecture','0079'); ?>
                    </a>
                </div>
            <?php
            }
            ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
    calendarId='#dateTimePicker'+<?php echo $data['teacher_id']; ?>;
    var firstday = new Date();
    var lastday = new Date();
    lastday.setDate(firstday.getDate()+366);
    $(calendarId).datetimepicker({
        format: "yyyy-mm-dd",
        language: "<?php echo 'ru'?>",
        weekStart: 1,
        todayBtn:  0,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        startDate:  firstday,
        endDate:  lastday
    });
    $(calendarId).datetimepicker('setDaysOfWeekDisabled', [0,6]);
</script>