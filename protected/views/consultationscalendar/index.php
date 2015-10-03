<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/consultations.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/scripts/bootstrap-datetimepicker/bootstrap/css/bootstrap.css">
<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/scripts/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css">

<!--<script type="text/javascript" src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/scripts/bootstrap-datetimepicker/bootstrap/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ua.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ru.js"></script>


<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/parseTable.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/showHideCalendarTabs.js"></script>

<?php
$this->pageTitle = 'INTITA';

if($idCourse != 0) {
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        $lecture->getCourseInfoById($idCourse)['courseTitle'] => Yii::app()->createUrl('course/index', array('id' => $idCourse)),
        $lecture->getModuleInfoById($idCourse)['moduleTitle'] => Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'], 'idCourse' => $idCourse)),
        $lecture[LectureHelper::getTypeTitleParam()] => Yii::app()->createUrl('lesson/index', array('id' => $lecture['id'], 'idCourse' => $idCourse)), Yii::t("consultation", "0506"),
    );
}else{
    $this->breadcrumbs = array(
        ModuleHelper::getModuleName($lecture->idModule) => Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'])),
        $lecture[LectureHelper::getTypeTitleParam()] => Yii::app()->createUrl('lesson/index', array('id' => $lecture['id'], 'idCourse' => '0')), Yii::t("consultation", "0506"),
    );
}
?>
<div class="consultationsMainBlock" >
    <h1 class="consultations"><?php echo Yii::t("consultation", "0506")?></h1>
    <?php
    $this->widget('application.components.ColumnListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_consultants',
        'emptyText' => 'Консультантів з питань цього модуля немає.',
        'summaryText' => '',
        'viewData' => array('lecture' => $lecture, 'idCourse'=>$idCourse),
        'columns'=>array("one","two"),
    ));
    ?>
</div>
