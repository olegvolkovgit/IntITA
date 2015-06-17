<p id="timeTitle">Виберіть годину</p><button id="exitButton" onclick="goOut('<?php echo $teacherId; ?>')">x</button>
<p  id="timeDate" onclick="chooseDate('<?php echo $teacherId; ?>')"><?php echo (Yii::app()->language == 'ua')?$day:Yii::app()->dateFormatter->format("d MMMM y",strtotime($day)); ?></p>
<table class='timeGrid' id='<?php echo 'timeGrid'.$teacherId?>'>
    <?php
    for ($i = 9; $i < 23; $i++) {
        ?>
        <tr>
            <?php
            for ( $j = 0; $j < 3; $j++) {

                ?>

                <td class='<?php echo Consultationscalendar::classTD($teacherId,Consultationscalendar::timeInterval($i,$j,20),$day); ?>'>
                    <?php  echo Consultationscalendar::timeInterval($i,$j,20); ?>
                </td>
            <?php

            }
            ?>
        </tr>
    <?php

    }
    ?>
</table>

<div id="timeInfo">
    Ви можете вибрати декілька консультацій.
    Використовуйте клавіші <span class="colorP">Ctrl</span> або <span class="colorP">Shift</span>.
</div>

<button id="consultationBack" onclick="goBack('<?php echo $teacherId; ?>')">Назад</button>
<button id="consultationNext" onclick="goNext('<?php echo $teacherId; ?>')">Далі</button>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/timeSelect.js"></script>
