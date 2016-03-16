<?php
/**
 * @var $data UserAgreements
 */
?>
<br>
<a class="coursename" href="<?php echo Yii::app()->createUrl('payments/showAgreement', array('id' => $data->id)); ?>">
    <?=$data->service->description;?>
</a>
<br>
