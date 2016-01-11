<?php
/**
 * @var $receivedLettersProvider CActiveDataProvider
 * @var $sentLettersProvider CActiveDataProvider
 * @var $message UserMessages
 */
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'spoilerLetter.js'); ?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'profile.css'); ?>"/>
<div id="mylettersSend">
    <!--    <p class="tabHeader">--><?php //echo Yii::t("letter", "0531") ?><!--</p>-->
    <!---->
    <!--            <div class="box_tabs">-->
    <!--                <ul class="box_tab-links">-->
    <!--            <li><a href="#box_tab1">--><?php //echo Yii::t("letter", "0532") ?><!--</a></li>-->
    <!--            <li><a href="#box_tab2">--><?php //echo Yii::t("letter", "0533") ?><!--</a></li>-->
    <!--            <li class="active_box">-->
    <!--                <a class='createLetter' href="#box_tab5">-->
    <!--                    <img-->
    <!--                        src="-->
    <?php //echo StaticFilesHelper::createImagePath('common', 'send.jpg'); ?><!--"/>--><?php //echo Yii::t("letter", "0534") ?>
    <!--                </a>-->
    <!--            </li>-->
    <!--        </ul>-->

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo Yii::t("letter", "0531") ?>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li><a href="#received" data-toggle="tab"><?php echo Yii::t("letter", "0532") ?></a></li>
                <li><a href="#sent" data-toggle="tab"><?php echo Yii::t("letter", "0533") ?></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="received">
                    <?php
                    $lectures = Lecture::getAllNotVerifiedLectures();
                    foreach ($lectures as $record) {
                        echo "<span class='lectureTitle'><a href='" .
                            Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0)) . "'</a>" .
                            $record->title() . " <span class='moduleTitle'>(модуль - " .
                            $record->module->getTitle() . ")</span></span></a><br>";
                    }
                    ?>
                </div>
                <div class="tab-pane fade" id="sent">
                    <?php
                    $lecturesVerified = Lecture::getAllVerifiedLectures();
                    foreach ($lecturesVerified as $record) { ?>
                        <span class='lectureTitle'>
                                <a href="<?= Yii::app()->createUrl('lesson/index',
                                    array('id' => $record->id, 'idCourse' => 0)); ?>">
                                <?= $record->title(); ?>
                                </a>
                        </span>
                        <br>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!--        -->
    <!--        <div class="box_tab-content">-->
    <!--            <div id="box_tab1" class="box_tab">-->
    <!--                --><?php
    //                $this->widget('zii.widgets.CListView', array(
    //                    'dataProvider' => $receivedLettersProvider,
    //                    'itemView' => '_receivedLetters',
    //                    'viewData' => array('respletter' => $message),
    //                    'template' => '{items}{pager}',
    //                    'emptyText' => Yii::t("letter", "0535"),
    //                    'pager' => array(
    //                        'firstPageLabel' => '<<',
    //                        'lastPageLabel' => '>>',
    //                        'prevPageLabel' => '<',
    //                        'nextPageLabel' => '>',
    //                        'header' => '',
    //                    ),
    //                ));
    //                ?>
    <!--            </div>-->
    <!---->
    <!--            <div id="box_tab2" class="box_tab2">-->
    <!--                --><?php
    //                $this->widget('zii.widgets.CListView', array(
    //                    'dataProvider' => $sentLettersProvider,
    //                    'itemView' => '_sentLetters',
    //                    'viewData' => array('model' => $message),
    //                    'template' => '{items}{pager}',
    //                    'emptyText' => Yii::t("letter", "0536"),
    //                    'pager' => array(
    //                        'firstPageLabel' => '<<',
    //                        'lastPageLabel' => '>>',
    //                        'prevPageLabel' => '<',
    //                        'nextPageLabel' => '>',
    //                        'header' => '',
    //                    ),
    //                ));
    //                ?>
    <!--            </div>-->
    <!--            <div id="box_tab5" class="box_tab5">-->
    <!--                <div>-->
    <!--                    --><?php ////$this->renderPartial('_form', array('model' => $model)); ?>
    <!--                </div>-->
    <!--            </div>-->
</div>
<!--    </div>-->
<!--</div>-->

<script>
    jQuery(document).ready(function () {
        jQuery('.box_tabs ' + '#box_tab5').show().siblings().hide();
        jQuery('.box_tabs .box_tab-links a').on('click', function (e) {
            var currentAttrValue = jQuery(this).attr('href');

            // Show/Hide Tabs
            jQuery('.box_tabs ' + currentAttrValue).show().siblings().hide();

            // Change/remove current tab to active
            jQuery(this).parent('li').addClass('active_box').siblings().removeClass('active_box');

            e.preventDefault();
        });
    });
</script>