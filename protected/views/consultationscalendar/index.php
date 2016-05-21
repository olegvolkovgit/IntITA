<?php
/**
 * @var $user RegisteredUser
 */
?>
<? $css_version = 1; ?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'consultations.css') ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', '/bootstrap-datetimepicker/bootstrap/css/bootstrap.css'); ?>">
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', '/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css'); ?>">

<script  src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ua.js'); ?>"></script>
<script  src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ru.js'); ?>"></script>


<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'parseTable.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'showHideCalendarTabs.js'); ?>"></script>

<?php
if($idCourse != 0) {
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        Course::getCourseTitleForBreadcrumbs($idCourse) => Yii::app()->createUrl('course/index', array('id' => $idCourse)),
        $lecture->module->getTitleForBreadcrumbs() => Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'], 'idCourse' => $idCourse)),
        $lecture->titleForBreadcrumbs() => Yii::app()->createUrl('lesson/index', array('id' => $lecture['id'], 'idCourse' => $idCourse)), Yii::t("consultation", "0506"),
    );
}else{
    $this->breadcrumbs = array(
        $lecture->module->getTitleForBreadcrumbs() => Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'])),
        $lecture->titleForBreadcrumbs() => Yii::app()->createUrl('lesson/index', array('id' => $lecture['id'], 'idCourse' => '0')), Yii::t("consultation", "0506"),
    );
}
?>
<div class="consultationsMainBlock" >
    <h1 class="consultations"><?php echo Yii::t("consultation", "0506")?></h1>
    <?php
    if (isset(Yii::app()->session['lg'])) {
        if (Yii::app()->session['lg'] == 'en') {
            $lang='_en';
        }elseif(Yii::app()->session['lg'] == 'ru'){
            $lang='_ru';
        }else $lang='';
    }else $lang='';

    $this->widget('application.components.ColumnListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_consultants',
        'emptyText' => Yii::t('consultations', '0792'),
        'summaryText' => '',
        'viewData' => array('lecture' => $lecture, 'idCourse'=>$idCourse,'lg'=>$lang, 'user' => $user),
        'columns'=>array("one","two"),
    ));
    ?>
</div>
