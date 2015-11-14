<?php
/**
 * @var $page LecturePage;
 */
?>
<?php
if (is_string($_GET['page'])) $thisPage = $_GET['page'];
else if($editMode) $thisPage = 1;
else $thisPage = $lastAccessPage;

if (!($passedPages[$thisPage-1]['isDone'] || $editMode || AccessHelper::isAdmin())
){
    throw new CHttpException(403, Yii::t('lecture', '0640'));
}
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'cjuitabs.css'); ?>"/>
<div name="lecturePage">
    <?php $this->renderPartial('_lectureProgress', array('page'=>$page, 'finishedLecture' => $finishedLecture, 'passedLecture'=>$passedLecture, 'passedPages'=>$passedPages,'user'=>$user, 'thisPage'=>$thisPage, 'edit'=>0,  'editMode' => $editMode, 'idCourse' => $idCourse)); ?>
    <div ng-cloak class="tabsWidget">
        <?php
        $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs' => array(
                Yii::t('lecture', '0613') => array('id' => 'video', 'content' => $this->renderPartial(
                    '_videoTab',
                    array('page' => $page), true
                )),
                Yii::t('lecture', '0614') => array('id' => 'text', 'content' => $this->renderPartial(
                    '_textListTab',
                    array('dataProvider' => $dataProvider, 'editMode' => 0, 'user' => $user), true
                )),
                Yii::t('lecture', '0659') => array('id' => 'quiz', 'content' => $this->renderPartial(
                    '_quiz',
                    array('page' => $page, 'editMode' => 0, 'user' => $user), true
                )

                ),
            ),
            'options' => array(
                'collapsible' => true,
            ),
            'id' => 'MyTab-Menu',
        ));
        ?>
    </div>
</div>
<!--modal task congratulations-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog2',
    'themeUrl' => Config::getBaseUrl() . '/css',
    'cssFile' => 'jquery-ui.css',
    'theme' => 'my',
    'options' => array(
        'width' => 540,
        'autoOpen' => false,
        'modal' => true,
        'resizable' => false,
    ),
));
$this->renderPartial('/lesson/_modalTask', array('lastAccessPage' => $lastAccessPage, 'idCourse' => $idCourse));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!--modal task congratulations end-->
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'lectureProgress.js'); ?>"></script>

