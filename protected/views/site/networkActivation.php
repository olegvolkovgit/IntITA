<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 13.11.2015
 * Time: 13:18
 */
if(!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));
$this->pageTitle = 'INTITA';
?>
<?php
$this->breadcrumbs=array(Yii::t('activeemail','0303'));
?>
<div class='infoblock'>
    <h2><?php echo Yii::t('activeemail','0304'); ?></h2>
    <?php echo Yii::t('activeemail','0777'); ?>
</div>
