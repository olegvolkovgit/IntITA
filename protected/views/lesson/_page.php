<?php

if (isset($_COOKIE['lessonTab'])) $lessonTab = $_COOKIE['lessonTab']; else $lessonTab = 0;

$this->renderPartial('_jsLectureProgress', array('page' => $page, 'finishedLecture' => $finishedLecture, 'passedLecture' => $passedLecture, 'passedPages' => $passedPages, 'user' => $user, 'thisPage' => $thisPage, 'edit' => 0, 'editMode' => $editMode)); ?>
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
        'active' => $lessonTab,
    ),
    'id' => 'MyTab-Menu',
));
//}
?>
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
?>
<div class="mooda">
    <?php
    $lastAccessPage = $page['page_order'];
    $qForm = new StudentReg;
    if (is_string($_GET['page']))
        $page = $_GET['page'];
    else $page = $lastAccessPage;

    if (!isset($thisPage)) $thisPage = 1;
    $nextPage = LecturePage::getNextPage($id, $thisPage);
    ?>
    <div class="signIn2">
        <div id="heedd">
            <table>
                <tr>
                    <td>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'LessFinish.jpg'); ?>">
                    </td>
                    <td>
                        <h1 style=""><?php echo Yii::t('lecture', '0675'); ?></h1>
                    </td>
                </tr>
            </table>

            <div class="happily">
                <p><?php echo Yii::t('lecture', '0679'); ?></p>
            </div>
            <a id="signInButtonM2" href="#/page<?php echo $nextPage ?>"><?php echo Yii::t('lecture', '0681'); ?></a>
        </div>
    </div>
</div>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
