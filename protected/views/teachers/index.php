<?php
Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl(Yii::app()->request->url), null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag(Yii::t('teachers', '0058'), null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag("Якщо ви професійний ІТ-шник і бажаєте викладати окремі ІТ теми чи модулі і співпрацювати з нами в напрямку підготовки програмістів, напишіть нам листа.", 'description');
Yii::app()->clientScript->registerMetaTag('http://intita.itatests.com/images/mainpage/intitaLogo.jpg', null, null, array('property' => "og:image"));
?>
<body>
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
         data-title=<?php echo Yii::t('teachers', '0058'); ?>
         data-image="http://intita.itatests.com/images/mainpage/intitaLogo.jpg"
         data-description="Якщо ви професійний ІТ-шник і бажаєте викладати окремі ІТ теми чи модулі і співпрацювати з нами в напрямку підготовки програмістів, напишіть нам листа."
         data-path="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/share42.js"></script>
<?php
?>
<!-- teachers style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/teachers.css" />
<!-- teachers style -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/hideBlock.js"></script>
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