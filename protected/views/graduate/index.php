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