<?php
$teacher=Teacher::model()->findByPk($data['teacher_id']);
$lecture=Lecture::model()->findByPk($data['lecture_id']);
?>
<tr>
    <td>
        <div><?php echo Yii::t('profile', '0132'); ?></div>
    </td>
    <td>
        <div><?php echo $data['date_cons'] ?></div>
    </td>
    <td>
        <div><?php echo $data['start_cons']."-".$data['end_cons'] ?></div>
    </td>
    <td>
        <div><?php echo $teacher->first_name.' '.$teacher->last_name ?></div>
    </td>
    <td>
        <div><?php echo $lecture->title ?></div>
    </td>
</tr>