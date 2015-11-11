<?php
/* @var $this SiteController */
/* @var $message string */
/* @var $code integer */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
    Yii::t('error','0590'),
);
?>
<div class='errorblock'>
    <h1><?php echo Yii::t('error','0590')." ".$code; ?></h1>


    <div class="error">
    <?php echo CHtml::encode($message)?><br>
<!--    --><?php //echo 'File : ' . CHtml::encode($file) ?><!--<br>-->
<!--    --><?php //echo 'Line : ' . CHtml::encode($line) ?><!--<br>-->
    </div>
</div>