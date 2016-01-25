<p id="timeTitle"><?php echo Yii::t("consultation", "0499") ?></p><button id="exitButton" onclick="goOut('<?php echo $teacherId; ?>')">x</button>
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
    <?php echo Yii::t("consultation", "0500") ?>
</div>

<button id="consultationBack" onclick="goBack('<?php echo $teacherId; ?>')"><?php echo Yii::t("consultation", "0501") ?></button>
<button id="consultationNext" onclick="goNext('<?php echo $teacherId; ?>')"><?php echo Yii::t("consultation", "0502") ?></button>

<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'timeSelect.js'); ?>"></script>
<script>
    if($('.disabledTime').length==42) $('#consultationNext').attr('disabled','true');
</script>
