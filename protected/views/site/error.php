<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('error','590');
$this->breadcrumbs=array(
    Yii::t('error','590'),
);
?>
<div class='errorblock'>
    <h1><?php echo Yii::t('error','590')." ".$code; ?></h1>

    <div class="error">
    <?php echo CHtml::encode($message); ?>
    </div>
</div>