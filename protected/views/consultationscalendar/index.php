<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/consultations.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/bootstrap/css/bootstrap.css">
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css">

<!--<script type="text/javascript" src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/scripts/bootstrap-datetimepicker/bootstrap/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ua.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ru.js"></script>


<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/parseTable.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/showHideCalendarTabs.js"></script>

<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",$lecture->getCourseInfoById()['courseTitle']=>Yii::app()->createUrl('course/index', array('id' => 1)),$lecture->getModuleInfoById()['moduleTitle']=>Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'])),$lecture['title']=>Yii::app()->createUrl('lesson/index', array('id' => $lecture['id'])),'Консультації',
);
?>
<div class="consultationsMainBlock" >
    <h1 class="consultations"><?php echo 'Консультації'?></h1>
    <?php
    $this->widget('application.components.ColumnListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_consultants',
        'summaryText' => '',
        'viewData' => array('lecture' => $lecture),
        'columns'=>array("one","two"),
    ));
    ?>
</div>
