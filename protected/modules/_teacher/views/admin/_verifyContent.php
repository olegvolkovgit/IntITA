<?php
/**
 * @var $record Lecture
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'verifyContent.css'); ?>"/>

<a href="<?php echo Yii::app()->createUrl('/_admin/verifyContent/initializeDir') ?>">Ініціалізація</a>
<br>
<br>
<div class="panel panel-default">
    <div class="panel-heading">
        Лекції
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li><a href="#wait" data-toggle="tab">Очікують підтвердження</a>
            </li>
            <li><a href="#verified" data-toggle="tab">Затверджені</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="wait">
                <?php
                $lectures = Lecture::getAllNotVerifiedLectures();
                foreach($lectures as $record) {
                    echo "<a href='".Yii::app()->createUrl('/_admin/verifyContent/confirm', array('id' => $record->id)).
                        "' class='confirm'>Затвердити   </a>     <span class='lectureTitle'><a href='" .
                        Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0)) . "'</a>" .
                        $record->title() . " <span class='moduleTitle'>(модуль - " .
                        $record->module->getTitle().")</span></span></a><br>";
                }
                ?>
            </div>
            <div class="tab-pane fade" id="verified">
                <?php
                $lecturesVerified = Lecture::getAllVerifiedLectures();
                foreach($lecturesVerified as $record) {
                    echo "<a href='".Yii::app()->createUrl('/_admin/verifyContent/cancel', array('id' => $record->id)).
                        "' class='confirm'>Скасувати   </a>     <span class='lectureTitle'><a href='" .
                        Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0)) . "'</a>" .
                        $record->title() . " <span class='moduleTitle'>(модуль - " .
                        $record->module->getTitle().")</span></span></a><br>";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->




