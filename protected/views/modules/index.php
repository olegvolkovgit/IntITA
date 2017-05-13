<? $css_version = 1; ?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'module.css'); ?>"/>

<h2 id="modulesHeader"><?php echo Yii::t('module', '0964'); ?></h2>
<div class="lessonModule" id="lectures">
    <?php
    $this->pageTitle = 'INTITA';
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'lectures-grid',
        'dataProvider' => $dataProvider,
        'emptyText' => Yii::t('module', '0375'),
        'columns' => array(
            array(
                'name' => 'title',
                'type' => 'raw',
                'header' => false,
                'htmlOptions' => array('class' => 'titleColumn'),
                'headerHtmlOptions' => array('style' => 'width:0%; display:none'),
                'value' => function ($data) {
                    $titleParam = Lecture::getTypeTitleParam();
                    if ($data->$titleParam == '') {
                        $titleParam = 'title_ua';
                    }
                    return CHtml::link(CHtml::encode($data->$titleParam), Yii::app()->createUrl("module/index", array("idModule" => $data->module_ID)));
                }
            ),
        ),
        'summaryText' => '',
        'pager' => array(
            'firstPageLabel' => '&#171;&#171;',
            'lastPageLabel' => '&#187;&#187;',
            'prevPageLabel' => '&#171;',
            'nextPageLabel' => '&#187;',
            'header' => '',
            'cssFile' => Config::getBaseUrl() . '/css/pager.css'
        ),
    ));
    ?>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>

