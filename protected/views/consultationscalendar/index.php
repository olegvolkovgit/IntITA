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
$title_lang=LectureHelper::getTypeTitleParam();
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",$lecture->getCourseInfoById($idCourse)['courseTitle']=>Yii::app()->createUrl('course/index', array('id' => $idCourse)),$lecture->getModuleInfoById($idCourse)['moduleTitle']=>Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'],'idCourse' => $idCourse)),$lecture[$title_lang]=>Yii::app()->createUrl('lesson/index', array('id' => $lecture['id'],'idCourse' => $idCourse)),Yii::t("consultation", "0506"),
);
?>
<div class="consultationsMainBlock" >
    <h1 class="consultations"><?php echo Yii::t("consultation", "0506")?></h1>
    <?php
    $this->widget('application.components.ColumnListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_consultants',
        'summaryText' => '',
        'viewData' => array('lecture' => $lecture, 'idCourse'=>$idCourse),
        'columns'=>array("one","two"),
    ));
    ?>
</div>
