<?php
/* @var $this CoursemanageController */
/* @var $dataProvider CActiveDataProvider */
?>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/create'); ?>">
            <?php echo Yii::t("coursemanage", "0511"); ?>
        </a>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/admin'); ?>">
            <?php echo Yii::t("coursemanage", "0512"); ?>
        </a>
    <br>
<!--        <a href="--><?php //echo Yii::app()->createUrl('/_admin/coursemanage/addExistModule'); ?><!--">-->
<!--            Додати існуючий модуль до курса-->
<!--        </a>-->
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'summaryText' => Yii::t("coursemanage", "0516") . ' {start} - {end} / {count}',
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => Config::getBaseUrl(). '/css/pager.css'
    ),
    'columns' => array(
        array(
            'name' => 'course_ID',
            'header' => 'ID',
        ),
        'course_number',
        array(
            'name' => 'title_ua',
            'header' => Yii::t("coursemanage", "0519"),
        ),
        array(
            'name' => 'title_ru',
            'header' => "Назва російською",
        ),
        array(
            'name' => 'title_en',
            'header' => 'Назва англійською',
        ),
        array(
            'name' => 'alias',
            'header' => 'Псевдонім',
        ),
        array(
            'name' => 'level',
            'header' => Yii::t("coursemanage", "0520"),
        ),
//        array(
//            'name' => 'course_duration_hours',
//            'header' => Yii::t("coursemanage", "0521"),
//        ),
//        array(
//            'name' => 'course_price',
//            'header' => Yii::t("coursemanage", "0522"),
//        ),
    ),
)); ?>