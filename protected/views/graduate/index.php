<?php
Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl(Yii::app()->request->url), null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag(Yii::t('graduates', '0297'), null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag("Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали", null, null, array('property' => "og:description"));
Yii::app()->clientScript->registerMetaTag(StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'), null, null, array('property' => "og:image"));
?>
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
         data-title="<?php echo Yii::t('graduates', '0297')?>"
         data-image='<?php StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>'
         data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"
         data-path="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/share42.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/GraduatesStyle.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SpoilerContent.js"></script>

<div class="subNavBlockGraduates">
    <?php
    $this->pageTitle = 'INTITA';
    $this->breadcrumbs=array(
        Yii::t('breadcrumbs', '0296'),
    );
    ?>
</div>
<div class="graduateBlock">
    <h1 class="graduates"><?php echo Yii::t('graduates', '0297')?></h1>
    <?php
    $this->widget('application.components.ColumnListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_graduateBlock',
        'summaryText' => '',
        'columns'=>array("one","two"),
    ));
    ?>
</div>