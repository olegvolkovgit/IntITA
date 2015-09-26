<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('graduates', '0297'),
    'description'=>'Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали',
));
?>
<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/GraduatesStyle.css" />

<div class="subNavBlockGraduates">
    <?php
    $this->pageTitle = 'INTITA';
    $this->breadcrumbs=array(
        Yii::t('breadcrumbs', '0296'),
    );
     ?>
</div>
<div class="graduateBlock">
    <div  class="graduates">
        <h1><?php echo Yii::t('graduates', '0297')?></h1>
        <?php echo $this->renderPartial('_graduateFilter'); ?>
    </div>
    <div id="graduateBlock">
        <?php echo $this->renderPartial('_graduatesList', array('dataProvider'=>$dataProvider)); ?>
    </div>
</div>