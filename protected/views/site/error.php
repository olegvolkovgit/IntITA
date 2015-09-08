<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Помилка';
$this->breadcrumbs=array(
	'Помилка',
);
?>
<div class='errorblock'>
    <h1>Помилка <?php echo $code; ?></h1>

    <div class="error">
    <?php echo CHtml::encode($message); ?>
    </div>
</div>