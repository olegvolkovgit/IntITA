<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('teachers', '0058'),
    'description'=>'Якщо ви професійний ІТ-шник і бажаєте викладати окремі ІТ теми чи модулі і співпрацювати з нами в напрямку підготовки програмістів, напишіть нам листа.',
));
?>
<!--data-url="--><?php //echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?><!--"-->
<!--data-title="--><?php //echo Yii::t('teachers', '0058'); ?><!--"-->
<!--data-image="--><?php //echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?><!--"-->
<!--data-description="Якщо ви професійний ІТ-шник і бажаєте викладати окремі ІТ теми чи модулі і співпрацювати з нами в напрямку підготовки програмістів, напишіть нам листа."-->
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-path="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'share42/share42.js') ?>"></script>
<?php
?>
<!-- teachers style -->
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'teachers.css'); ?>" />
<!-- teachers style -->
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'hideBlock.js'); ?>"></script>
<?php
$this->pageTitle = 'INTITA';
$post=$dataProvider->getData();
?>
<!-- BD -))) -->
<div class="subNavBlockTeachers">
    <?php
    $this->breadcrumbs=array(
        Yii::t('breadcrumbs', '0052'));
    ?>
</div>
<div class='teachersList'>
    <div class="titleTeachers">
        <h1><?php echo Yii::t('teachers', '0058'); ?></h1>
    </div>
    <?php $this->renderPartial('_leftTeacher', array('post' => $post));  ?>
    <?php $this->renderPartial('_rightTeacher', array('post' => $post,'teacherletter'=>$teacherletter)); ?>
</div>